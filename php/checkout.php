<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Signin.php");
    exit();
}

$host = 'localhost';
$dbname = 'projectrpl';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['save_address']) && !empty($_POST['new_address'])) {
    $_SESSION['shipping_address'] = trim($_POST['new_address']);

    $redirect = 'checkout.php';
    if (isset($_SESSION['buy_now'])) {
        $redirect .= '?buy_now=1';
    }

    header("Location: $redirect");
    exit();
}



$stmt_user = $pdo->prepare("
    SELECT u.name, p.address
    FROM users u
    LEFT JOIN user_profiles p ON u.id = p.user_id
    WHERE u.id = :user_id
");
$stmt_user->execute([':user_id' => $user_id]);
$user_data = $stmt_user->fetch(PDO::FETCH_ASSOC);

$username = $user_data['name'] ?? 'Guest';
$address = $_SESSION['shipping_address'] ?? ($user_data['address'] ?? 'Alamat belum diatur');
$cart_items = [];
$total_price = 0;

$cart_items = [];
$total_price = 0;
$total_quantity = 0;

if (isset($_GET['buy_now']) && isset($_SESSION['buy_now'])) {
    $product_id = $_SESSION['buy_now']['product_id'];
    $quantity = $_SESSION['buy_now']['quantity'];

    $stmt = $pdo->prepare("SELECT name AS product_name, image AS product_image, price FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $product['quantity'] = $quantity;
        $cart_items[] = $product;
        $total_price = $product['price'] * $quantity;
        $total_quantity = $quantity;
    }

} else {
    $stmt_cart = $pdo->prepare("
        SELECT products.name AS product_name, products.image AS product_image, products.price, cart.quantity 
        FROM cart
        INNER JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = :user_id
    ");
    $stmt_cart->execute([':user_id' => $user_id]);
    $cart_items = $stmt_cart->fetchAll(PDO::FETCH_ASSOC);

    $stmt_total_quantity = $pdo->prepare("
        SELECT SUM(quantity) AS total_quantity
        FROM cart
        WHERE user_id = :user_id
    ");
    $stmt_total_quantity->execute([':user_id' => $user_id]);
    $total_quantity = $stmt_total_quantity->fetchColumn();

    foreach ($cart_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleCheckout.css" />
    <link rel="stylesheet" href="../css/styleBase.css" />
    <link href="../img/IKAE.png" rel="icon">
    <title>Checkout</title>
</head>
<body>
    <?php include "../layout/header.html" ?>
    <div class="container2">
        <div class="section-title">Pengiriman</div>
        <div class="main-content">
            <div class="left-content">
                <div class="section-title">Checkout Barang</div>
                <?php if (!empty($cart_items)): ?>
                    <?php foreach ($cart_items as $item): ?>
                        <div class="product-card card">
                            <img alt="Product Image" height="100" src="<?php echo htmlspecialchars($item['product_image']); ?>" width="100"/>
                            <div class="details">
                                <h4><?php echo htmlspecialchars($item['product_name']); ?></h4>
                                <p class="price">Rp<?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                                <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="summary-cards card">
                    <div class="option">
                        <p><strong>Pilih Metode Pengiriman:</strong></p>
                        <div>
                            <input type="radio" id="regular" name="delivery" value="20000" checked onclick="updateTotal()">
                            <label for="regular">Regular Delivery - Rp20,000</label>
                        </div>
                        <div>
                            <input type="radio" id="nextday" name="delivery" value="50000" onclick="updateTotal()">
                            <label for="nextday">Next Day Delivery - Rp50,000</label>
                        </div>
                        <div>
                            <input type="radio" id="instant" name="delivery" value="70000" onclick="updateTotal()">
                            <label for="instant">Instant/Same Day Delivery - Rp70,000</label>
                        </div>
                    </div>
                    </div>   
                <?php else: ?>
                    <p>Keranjangmu kosong.</p>
                <?php endif; ?>
            </div>
            <div class="right-content">
                <div class="summary-card card">
                    <h3>Ringkasan Belanja</h3>
                    <div class="option">
                        <p class="total">Total <?php echo $total_quantity; ?> Barang</p>
                        <p class="total">Alamat Pengiriman : </p>
                        <p class="total">Rumah • <?php echo htmlspecialchars($username); ?></p>
                        <p class="total"><?php echo htmlspecialchars($address); ?></p>
                        <a class="button" href="#popup1">Ganti alamat</a>
                          </div>
                    <div class="option">
                        <p class="total">Total Harga:</p>
                        <p id="total-price" class="total">Rp<?php echo number_format($total_price + 20000, 0, ',', '.'); ?></p>
                    </div>
                    <div class="option">
                        <button id="pay-button" class="button">Checkout</button>
                    </div>

                    <script>
                        function updateTotal() {
                            const basePrice = <?php echo $total_price; ?>;
                            const deliveryOptions = document.getElementsByName("delivery");
                            let deliveryCost = 0;
                        
                            for (const option of deliveryOptions) {
                                if (option.checked) {
                                    deliveryCost = parseInt(option.value);
                                    break;
                                }
                            }
                            const totalPrice = basePrice + deliveryCost;
                            document.getElementById("total-price").innerText = "Rp" + totalPrice.toLocaleString("id-ID");
                        }

                        document.getElementById('pay-button').addEventListener('click', function () {
                            const deliveryOptions = document.getElementsByName("delivery");
                            let deliveryCost = 20000;
                            for (const option of deliveryOptions) {
                                if (option.checked) {
                                    deliveryCost = parseInt(option.value);
                                    break;
                                }
                            }

                            fetch('token.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    total_price: <?php echo $total_price; ?> + deliveryCost,
                                }),
                            })
                            .then((response) => response.json())
                            .then((data) => {
                                if (data.snapToken) {
                                    window.snap.pay(data.snapToken, {
                                        onSuccess: function (result) {
                                            window.location.href = 'success.php?order_id=' + data.order_id;
                                        },
                                        onPending: function (result) {
                                            window.location.href = 'checkout.php?order_id=' + data.order_id;
                                        },
                                        onError: function (result) {
                                            window.location.href = 'checkout.php?order_id=' + data.order_id;
                                        },
                                        onClose: function () {
                                            alert('You closed the payment page!');
                                        },
                                    });
                                } else {
                                    alert('Failed to fetch payment token!');
                                }
                            })
                            .catch((error) => console.error('Error fetching Snap Token:', error));
                        });
                    </script>
                    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-G_HMk-QY3iYVRlcO"></script>
                </div>
            </div>
        </div>
    </div>

    <div id="popup1" class="overlay"> 
        <div class="popup"> 
            <h2>Masukkan Alamat Baru</h2>
            <a class="close" href ="#">&times;</a>
            <form method="post" id="address-form">
                <div class="search-box">
                    <input type="text" name="new_address" placeholder="Tulis nama alamat/Kota/Kecamatan tujuan pengiriman">
                </div>
                <input type="hidden" name="save_address" value="1">
                <button type="submit">Submit</button>
            </form>

        </div>
    </div>

<script>
  const form = document.getElementById('address-form');
  form.addEventListener('submit', function () {
    if (window.location.hash) {
      history.replaceState(null, null, window.location.pathname);
    }
  });
</script>
</body>
</html>
