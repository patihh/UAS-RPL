<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Signin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id']; 
    $productId = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;
    $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 0;

    if ($productId <= 0 || $quantity <= 0) {
        echo "<p>Invalid product or quantity.</p>";
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT id FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            echo "<p>Product does not exist.</p>";
            exit();
        }

        $stmt = $pdo->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$userId, $productId]);
        $existingCartItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingCartItem) {
            $newQuantity = $existingCartItem['quantity'] + $quantity;
            $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
            $stmt->execute([$newQuantity, $userId, $productId]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->execute([$userId, $productId, $quantity]);
        }

        header("Location: keranjang.php?success=1");
        exit();
    } catch (PDOException $e) {
        echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
} else {
    echo "<p>Invalid request method.</p>";
}
