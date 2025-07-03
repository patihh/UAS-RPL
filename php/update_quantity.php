<?php
$host = 'localhost';
$dbname = 'projectrpl';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

session_start();

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to modify your cart.");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];

    if (isset($_POST['increase'])) {
        $stmt = $pdo->prepare("
            UPDATE cart
            SET quantity = quantity + 1
            WHERE user_id = :user_id AND product_id = :product_id
        ");
        $stmt->execute([':user_id' => $user_id, ':product_id' => $product_id]);
    } elseif (isset($_POST['decrease'])) {
        $stmt = $pdo->prepare("
            UPDATE cart
            SET quantity = GREATEST(quantity - 1, 1)
            WHERE user_id = :user_id AND product_id = :product_id
        ");
        $stmt->execute([':user_id' => $user_id, ':product_id' => $product_id]);
    }

    header('Location: keranjang.php');
    exit();
} else {
    die("Invalid request.");
}
?>
