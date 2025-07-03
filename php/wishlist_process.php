<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$host = 'localhost';
$dbname = 'projectrpl';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['id_produk'])) {
        $product_id = $_POST['id_produk'];
        
        if (isset($_POST['add_wishlist'])) {
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $product = $stmt->fetch();
            $stmt = $pdo->prepare("INSERT INTO wishlist (user_id, product_id, product_name, price, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $user_id, 
                $product_id,
                $product['name'],
                $product['price'],
                $product['image']
            ]);
            
            $_SESSION['wishlist'][$product_id] = true;
            echo json_encode(['success' => true, 'action' => 'added']);
        } 
        else if (isset($_POST['remove_wishlist'])) {
            $stmt = $pdo->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
            $stmt->execute([$user_id, $product_id]);
            unset($_SESSION['wishlist'][$product_id]);
            echo json_encode(['success' => true, 'action' => 'removed']);
        }
        exit;
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit;
}
