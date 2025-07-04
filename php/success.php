<?php
session_start();
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
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_id'];
$stmt_cart = $pdo->prepare("
    SELECT products.id AS product_id, products.name AS product_name, products.price, cart.quantity
    FROM cart
    INNER JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = :user_id
");
$stmt_cart->execute([':user_id' => $user_id]);
$cart_items = $stmt_cart->fetchAll(PDO::FETCH_ASSOC);

if (empty($cart_items)) {
    die("No items in the cart.");
}

$stmt_transaction = $pdo->prepare("
    INSERT INTO transactions (order_id, user_id, total_price, transaction_date)
    VALUES (:order_id, :user_id, :total_price, NOW())
");
$total_price = array_reduce($cart_items, function ($sum, $item) {
    return $sum + ($item['price'] * $item['quantity']);
}, 0);
$stmt_transaction->execute([
    ':order_id' => $order_id,
    ':user_id' => $user_id,
    ':total_price' => $total_price,
]);

$transaction_id = $pdo->lastInsertId();
$stmt_details = $pdo->prepare("
    INSERT INTO transaction_details (transaction_id, product_id, product_name, quantity, price)
    VALUES (:transaction_id, :product_id, :product_name, :quantity, :price)
");
foreach ($cart_items as $item) {
    $stmt_details->execute([
        ':transaction_id' => $transaction_id,
        ':product_id' => $item['product_id'],
        ':product_name' => $item['product_name'],
        ':quantity' => $item['quantity'],
        ':price' => $item['price'],
    ]);
}

$stmt_clear_cart = $pdo->prepare("DELETE FROM cart WHERE user_id = :user_id");
$stmt_clear_cart->execute([':user_id' => $user_id]);
header("Location: Home.php");
exit();
?>
