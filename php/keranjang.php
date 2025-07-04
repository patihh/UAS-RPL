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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="../css/styleCart-1.css">
    <link href="../img/IKAE.png" rel="icon">
</head>
<body>
    <?php include "../layout/header.html"; ?>

    <div class="halaman-cart">
        <h1 class="keranjang">Keranjang</h1>

        <div class="main-content">
            <div class="product-list">
                <?php if ($cartItems): ?>
                    <?php foreach ($cartItems as $item): 
                        $name = $item['name'] ?? 'Produk Tidak Diketahui';
                        $image = $item['image'] ?? '../img/default.png';
                        $price = $item['price'] ?? 0;
                        $quantity = $item['quantity'] ?? 0;
                        $total = $price * $quantity;

                        $totalQuantity += $quantity;
                        $totalPrice += $total;
                    ?>
                    <div class="product-box">
                        <img class="product-image" src="<?php echo htmlspecialchars($image); ?>" alt="Product Image">
                        <div class="product-details">
                            <p class="product-title"><?php echo htmlspecialchars($name); ?></p>
                            <p class="price">Rp<?php echo number_format($price, 2, ',', '.'); ?></p>
                            <div class="quantity-selector">
                                <form action="update_quantity.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                    <button type="submit" name="decrease" value="-">−</button>
                                    <span><?php echo $quantity; ?></span>
                                    <button type="submit" name="increase" value="+">+</button>
                                </form>
                            </div>

                            <form action="remove_from_cart.php" method="post" onsubmit="return confirm('Yakin ingin menghapus produk ini dari keranjang?');">
                                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                <button type="submit" class="delete-button">Hapus</button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada produk di keranjang.</p>
                <?php endif; ?>
            </div>

            <div class="summary-box">
                <p class="summary-title">Ringkasan Belanja</p>
                <p class="total-label">Total Barang: <span><?php echo $totalQuantity; ?> item</span></p>
                <p class="total-price">Rp<?php echo number_format($totalPrice, 2, ',', '.'); ?></p>
                <form action="checkout.php" method="post">
                    <button class="checkout-button" type="submit">Beli (<?php echo $totalQuantity; ?>)</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
