<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Signin.php");
    exit();
}

$host = 'localhost';
$dbname = 'projectrpl';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT 
        p.id AS product_id,
        p.name AS product_name,
        p.image AS product_image,
        p.price AS product_price
    FROM wishlist w
    INNER JOIN products p ON w.product_id = p.id
    WHERE w.user_id = :user_id
");
$stmt->execute([':user_id' => $user_id]);
$wishlist_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="../css/styleBase.css" />
	<link rel="stylesheet" href="../css/wishnew.css" />
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" />  
    <link rel="stylesheet" href="../css/sidebar.css" />	
	<link href="../img/IKAE.png" rel="icon">
    <title>Wishlist</title>
</head>
<body class="profile-page">
    <?php include "../layout/header.html"?>
  	<div class="profile">
			<div class="kiri">
				<?php include "sidebar.php" ?>
				<?php if (!empty($wishlist_items)): ?>
					<?php foreach ($wishlist_items as $item): ?>
						<div class="item">
							<form class="kotak-hapus" method="post" action="removewishlist.php">
								<input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
								<button type="submit" class="delete-btn">
									<img src="../img/trash.png" alt="Delete">
								</button>
							</form>
							
							<img class="image" src="<?php echo htmlspecialchars($item['product_image']); ?>" />
							<div class="detail-wishlist">
								<p class="text-wrapper"><?php echo htmlspecialchars($item['product_name']); ?></p>
								<div class="div">Rp<?php echo number_format($item['product_price'], 0, ',', '.'); ?></div>
								<div class="text-wrapper-2">Jakarta</div>
								<div class="frame">
									<img class="vector" src="../img/bintang.svg" />
									<p class="element-terjual">
										<span class="span">5.0</span>
										<span class="text-wrapper-3">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
										<span class="span">10+ Terjual</span>
									</p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<p>Your wishlist is empty.</p>
				<?php endif; ?>
        	</div>			
    	</div>
  	</div>
</body>
</html>
