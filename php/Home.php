<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Signin.php");
    exit();
}

include "db.php";
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleguide.css" />
    <link rel="stylesheet" href="../css/styleBuySell.css" />
    <link href="../img/IKAE.png" rel="icon">
    <title>Home</title>
</head>
<body>
    <?php 
        include "../layout/header.html"; 
        include "db.php";
    ?>
    <div class="square">
        <div class="category">
            <a href="Home.php?category=ruangTamu" class="box-category" style="background-image: url('../img/ruangtamu.png');">
                <div class="text-category"><p>Ruang Tamu</p></div>
            </a>
            <a href="Home.php?category=kamarTidur" class="box-category" style="background-image: url('../img/kamartidur.png');">
                <div class="text-category"><p>Kamar Tidur</p></div>
            </a>
            <a href="Home.php?category=dapur" class="box-category" style="background-image: url('../img/dapur.png');">
                <div class="text-category"><p>Dapur</p></div>
            </a>
            <a href="Home.php?category=kamarMandi" class="box-category" style="background-image: url('../img/kamarmandi.png');">
                <div class="text-category"><p>Kamar Mandi</p></div>
            </a>
            <a href="Home.php?category=outdoor" class="box-category" style="background-image: url('../img/outdoor.png');">
                <div class="text-category"><p>Outdoor</p></div>
            </a>
        </div>
        

        <div class="products">
            <?php
            $category = isset($_GET['category']) ? $_GET['category'] : null;
            if ($category) {
                $stmt = $pdo->prepare("SELECT * FROM products WHERE category = :category");
                $stmt->execute([':category' => $category]);
            } else {
                $stmt = $pdo->query("SELECT * FROM products");
            }
            while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="product-container">
                    <a href="product-detail.php?id=<?php echo $product['id']; ?>" style="text-decoration: none">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
                        <div class="product-caption">
                            <p class="product-name"><?php echo htmlspecialchars($product['name']); ?></p>
                            <div class="product-price">Price: Rp<?php echo number_format($product['price'], 2); ?></div>
                            <div class="location">Jakarta</div>
                            <div class="rating">
                                <img src="../img/bintang.svg" />
                                <p>5.0</p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>