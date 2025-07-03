<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Signin.php");
    exit();
}

$host = 'localhost';
$dbname = 'projectppw';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$stmt = $pdo->prepare("DELETE FROM wishlist WHERE user_id = :user_id AND product_id = :product_id");
$stmt->execute([':user_id' => $user_id, ':product_id' => $product_id]);
header("Location: wishnew.php");
exit();
?>
