<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy_now'])) {
    $_SESSION['buy_now'] = [
        'product_id' => $_POST['product_id'],
        'quantity' => $_POST['quantity']
    ];
    $_SESSION['last_buy_now'] = true;

    header("Location: checkout.php?buy_now=1");
    exit();
}

$host = 'localhost';
$dbname = 'projectrpl';
$username = 'root';
$password = '';

if (!isset($_SESSION['user_id'])) {
    header("Location: Signin.php");
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $product_id = intval($_GET['id']);
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            echo "<p>Produk tidak ditemukan.</p>";
            exit();
        }
    } else {
        echo "<p>ID Produk tidak ada.</p>";
        exit();
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit();
}
?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleguide.css" />
    <link rel="stylesheet" href="../css/styleBuySell.css" />
    <link href="../img/IKAE.png" rel="icon">
    <title>Detail Produk</title>
</head>
<body class='product-detail'>
    <?php include "../layout/header.html"?>
    <div class="square">
        <div class="content">
            <div class="gambar-product">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class='isian'>
                <div class="detail-product">
                    <p class="nama-product"><?php echo htmlspecialchars($product['name']); ?></p>
                    <div class='rating'>
                        <img src='../img/bintang.svg'>
                        <p>5.0</p>
                    </div>
                    <p class="product-price">Rp<?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                    <p class="deskripsi"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>

                    <div class="toko">
                        <img src='../img/IKAE.png'>
                        <div class="nama-toko">
                            <p>IKAE Company<br>
                            <span>Online</span>
                            </p>
                        </div>
                    </div>

                    <div class="pengiriman">
                        <h1>Lokasi</h1>
                        <div class="location">
                            <img src="../img/location.svg">Jakarta
                        </div>
                    </div>
                </div>
                <div class="ke-keranjang">
                    <div class="keranjang-beli-container">
                        <?php 
                        $stmt = $pdo->prepare("SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?");
                        $stmt->execute([$user_id, $product['id']]);
                        $isInWishlist = $stmt->fetch();
                        ?>
                        <form action="addcart.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                        <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
                    
                        <label for="quantity" style="padding-top: 5px; padding-bottom: 20px; display: block;">Jumlah Barang:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1" required style="margin-bottom: 10px;">
                        <button type="submit" class="keranjang">Tambah ke Keranjang</button>
                    </form>

                        <form method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" name="buy_now" class="keranjang" >Beli</button>
                        </form>
                    </div>

                    <button onclick="toggleWishlist(<?php echo $product['id']; ?>)" class="wish-btn">
                        <img src="../img/<?php echo $isInWishlist ? 'Full-Heart.png' : 'Outline-Heart.png'; ?>" 
                            alt="Wishlist" 
                            id="heart-<?php echo $product['id']; ?>"
                            style="width: 25px; height: 25px;">
                    </button>
                </div>
            </div>
        </div>
        <div class="lihat">
        <p>Produk Lain</p>
        <div class="products">
            <?php
            include "db.php";

            $currentProductId = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id != ? LIMIT 6");
            $stmt->execute([$currentProductId]);

            while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="product-container">
                    <a href="product-detail.php?id=<?php echo $product['id']; ?>" style="text-decoration: none">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
                        <div class="product-caption">
                            <p class="product-name"><?php echo htmlspecialchars($product['name']); ?></p>
                            <div class="product-price">Price: Rp<?php echo number_format($product['price'], 2); ?></div>
                            <div class="location">Jakarta</div>
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <script>
    function toggleWishlist(productId) {
        const heartIcon = document.getElementById(`heart-${productId}`);
        const isInWishlist = heartIcon.src.includes('Full-Heart.png');
        
        fetch('wishlist_process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id_produk=${productId}&${isInWishlist ? 'remove_wishlist' : 'add_wishlist'}=1`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const newSrc = isInWishlist ? '../img/Outline-Heart.png' : '../img/Full-Heart.png';
                heartIcon.src = newSrc;
                const allHeartIcons = document.querySelectorAll(`[id="heart-${productId}"]`);
                allHeartIcons.forEach(icon => {
                    icon.src = newSrc;
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }
    </script>
    </body>
    </html>

    </div>
    </div>
</body>
</html>