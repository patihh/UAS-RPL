<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Signin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['product_id'])) {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];

    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id");
    $stmt->execute([
        ':user_id' => $userId,
        ':product_id' => $productId
    ]);
}

header("Location: keranjang.php");
exit();
