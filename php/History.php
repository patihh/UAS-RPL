<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleHistory.css" />
    <link rel="stylesheet" href="../css/styleBase.css"/>
    <link href="../img/IKAE.png" rel="icon">
    <link rel="stylesheet" href="../css/wishnew.css" />
    <link rel="stylesheet" href="../css/sidebar.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" />
    <title>Daftar Transaksi</title>
</head>
<body class="profile-page">
    <?php include "../layout/header.html"; ?>

    <div class="profile">
        <div class="kiri">
        <?php include "sidebar.php"; ?>
            <div class="halaman-cart">
                <h1 class="keranjang">Daftar Transaksi</h1>

                <div class="main-content">
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
                        die("User not logged in.");
                    }
                    $user_id = $_SESSION['user_id'];
                    $stmt = $pdo->prepare("
                        SELECT t.id, t.order_id, t.total_price, t.transaction_date
                        FROM transactions t
                        WHERE t.user_id = :user_id
                        ORDER BY t.transaction_date DESC
                    ");
                    $stmt->execute([':user_id' => $user_id]);
                    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (empty($transactions)): ?>
                        <p>You have no transactions yet.</p>
                    <?php else: ?>
                        <?php foreach ($transactions as $transaction): ?>
                            <div class="transaction">
                                <h2>Order ID: <?php echo htmlspecialchars($transaction['order_id']); ?></h2>    
                                    <?php
                                    $stmt_details = $pdo->prepare("
                                        SELECT p.image, td.product_name, td.quantity, td.price, p.description 
                                        FROM transaction_details td
                                        INNER JOIN products p ON td.product_id = p.id
                                        WHERE td.transaction_id = :transaction_id

                                    ");
                                    $stmt_details->execute([':transaction_id' => $transaction['id']]);
                                    $details = $stmt_details->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($details as $detail): ?>
                                    <div class="product-card">
                                        <img class="product-thumb" src="<?php echo htmlspecialchars($detail['image']); ?>" alt="Product Image">
                                        <div class="product-info">
                                            <p class="product-title"><?php echo htmlspecialchars($detail['product_name']); ?></p>
                                            <p class="product-desc"><?php echo nl2br(htmlspecialchars($detail['description'])); ?></p>
                                            <p class="product-quantity">Quantity: <?php echo $detail['quantity']; ?></p>
                                            <p class="product-price">Rp<?php echo number_format($detail['price'], 0, ',', '.'); ?></p>
                                            <p class="product-date">
                                                <span class="check-icon">✔</span> Dibayar pada <?php echo date('d M Y H:i', strtotime($transaction['transaction_date'])); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
