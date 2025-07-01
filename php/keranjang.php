<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: Signin.php");
    exit();
}

$userId = $_SESSION['user_id']; 

$stmt = $pdo->prepare("
    SELECT cart.*, products.name, products.image, products.price 
    FROM cart 
    INNER JOIN products ON cart.product_id = products.id 
    WHERE cart.user_id = :user_id
");
$stmt->execute([':user_id' => $userId]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalQuantity = 0;
$totalPrice = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleCart-1.css" />
    <link href="img/PepewShopIcon.png" rel="icon">
    <title>Cart</title>
</head>
<body>
    <?php include "layout/header.html"; ?>

    <div class="halaman-cart">
        <h1 class="keranjang">Keranjang</h1>

        <div class="main-content">
            <div class="product-list">
                <?php
                if ($cartItems) {
                    foreach ($cartItems as $item) {
                        $quantity = $item['quantity'];
                        $price = $item['price'];
                        $totalQuantity += $quantity;
                        $totalPrice += $price * $quantity;
                        ?>
                        <div class="product-box">
                            <div class="checkbox"></div>
                            <img class="product-image" src="<?php echo htmlspecialchars($item['image']); ?>" alt="Product Image">
                            <div class="product-details">
                                <p class="product-title"><?php echo htmlspecialchars($item['name']); ?></p>
                                <p class="price">Rp<?php echo number_format($price, 2, ',', '.'); ?></p>
                                <div class="quantity-selector">
                                    <form action="update_quantity.php" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                        <button type="submit" name="decrease" value="-">-</button>
                                        <span><?php echo $quantity; ?></span>
                                        <button type="submit" name="increase" value="+">+</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No items in the cart.</p>";
                }
                ?>
            </div>
            <div class="summary-box">
                <p class="summary-title">Ringkasan Belanja</p>
                <p class="total-label">Total: <?php echo $totalQuantity; ?> items</p>
                <p class="total-price">Rp<?php echo number_format($totalPrice, 2, ',', '.'); ?></p>
                <form action="checkout.php" method="post">
                    <button class="checkout-button" type="submit">Beli (<?php echo $totalQuantity; ?>)</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
