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
</head>
<body>
    <?php 
        include "../layout/header.html"; 
        include "db.php";
    ?>

    <div class="category">
        <a href="Home.php?category=Romance" class="box-category" style="background-image: url('img/romance.jpg');">
            <div class="text-category"><p>Romance</p></div>
        </a>
        <a href="Home.php?category=Fantasy" class="box-category" style="background-image: url('img/fantasy.jpg');">
            <div class="text-category"><p>Fantasy</p></div>
        </a>
        <a href="Home.php?category=Mystery" class="box-category" style="background-image: url('img/mystery.jpg');">
            <div class="text-category"><p>Mystery</p></div>
        </a>
        <a href="Home.php?category=Horror" class="box-category" style="background-image: url('img/horror.jpg');">
            <div class="text-category"><p>Horror</p></div>
        </a>
        <a href="Home.php?category=Education" class="box-category" style="background-image: url('img/education.jpg');">
            <div class="text-category"><p>Education</p></div>
        </a>
        <a href="Home.php?category=Comedy" class="box-category" style="background-image: url('img/comedy.jpg');">
            <div class="text-category"><p>Comedy</p></div>
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
                <a href="product-detail.php?id=<?php echo $product['id']; ?>">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
                    <div class="product-caption">
                        <p class="product-name"><?php echo htmlspecialchars($product['name']); ?></p>
                        <div class="product-price">Price: Rp<?php echo number_format($product['price'], 2); ?></div>
                        <div class="location">Jakarta Timur</div>
                        <div class="rating">
                            <img src="img/bintang.svg" />
                            <p>5.0<span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>0+ Terjual</p>
                        </div>
                    </div>
                </a>
            </div>
            <?php
        }
        ?>
    </div>
</body>
</html>
