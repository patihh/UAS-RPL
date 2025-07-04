<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$total_price = $data['total_price'] ?? 0;
$host = 'localhost';
$dbname = 'projectrpl';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    exit();
}

$stmt_customer = $pdo->prepare("SELECT name, email FROM users WHERE id = :user_id");
$stmt_customer->execute([':user_id' => $_SESSION['user_id']]);
$customer = $stmt_customer->fetch(PDO::FETCH_ASSOC);
$stmt_cart = $pdo->prepare("
    SELECT products.id AS product_id, products.name AS product_name, products.price, cart.quantity
    FROM cart
    INNER JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = :user_id
");

$stmt_cart->execute([':user_id' => $_SESSION['user_id']]);
$cart_items = $stmt_cart->fetchAll(PDO::FETCH_ASSOC);
$item_details = [];
foreach ($cart_items as $item) {
    $item_details[] = [
        'id' => $item['product_id'],
        'price' => $item['price'],
        'quantity' => $item['quantity'],
        'name' => substr($item['product_name'], 0, 50),
    ];
}

$item_details[] = [
    'id' => 'DELIVERY',
    'price' => $total_price - array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart_items)),
    'quantity' => 1,
    'name' => 'Shipping Fee',
];

$order_id = "ORDER-" . uniqid();
$params = [
    'transaction_details' => [
        'order_id' => $order_id,
        'gross_amount' => $total_price,
    ],
    'customer_details' => [
        'first_name' => $customer['name'] ?? 'Guest',
        'email' => $customer['email'] ?? 'guest@example.com',
    ],
    'item_details' => $item_details,
];

require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php';
\Midtrans\Config::$serverKey = 'SB-Mid-server-2CphJa4SZnrTgA1rsfh8zkpe';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo json_encode(['snapToken' => $snapToken, 'order_id' => $order_id]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
