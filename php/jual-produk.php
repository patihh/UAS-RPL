<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Signin.php");
    exit();
}

if ($_SESSION['user_id'] !==18) {
    header("Location: Home.php");
    exit();
}

$host = 'localhost';
$dbname = 'projectrpl';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $price = trim($_POST["price"]);

        $error_message = "";
        $success_message = "";

        if (!empty($name) && !empty($description) && is_numeric($price) && !empty($_FILES["image"]["name"])) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            $target_file = $target_dir . uniqid() . "_" . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image"]["tmp_name"]);

            if ($check !== false && in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $pdo->beginTransaction();
                    
                    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (:name, :description, :price, :image)");
                    $stmt->execute([
                        ':name' => $name,
                        ':description' => $description,
                        ':price' => $price,
                        ':image' => $target_file
                    ]);

                    $product_id = $pdo->lastInsertId();
                    $stmt = $pdo->prepare("INSERT INTO users_products (user_id, original_product_id) VALUES (:user_id, :product_id)");
                    $stmt->execute([
                        ':user_id' => $_SESSION['user_id'],
                        ':product_id' => $product_id
                    ]);

                    $pdo->commit();
                    header("Location: Home.php");
                    exit();
                } else {
                    $error_message = "Terjadi kesalahan saat mengunggah gambar, silakan coba lagi.";
                }
            } else {
                $error_message = "Format yang diizinkan: JPG, JPEG, PNG & GIF.";
            }
        } else {
            $error_message = "Harap isi semua kolom yang diperlukan.";
        }
    }
} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $error_message = "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="../css/styleJualProduk.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;700&display=swap" />
    <link href="../img/IKAE.png" rel="icon">
    <title>Tambah Produk</title>
</head>
<body class='jual-product'>
    <?php include "../layout/header.html"; ?>
    
    <div class="form-jual">
        <form action="jual-produk.php" method="POST" enctype="multipart/form-data" class="submission" autocomplete="off">
            <?php if (!empty($success_message)): ?>
                <p style="color: green;"><?php echo htmlspecialchars($success_message); ?></p>
            <?php endif; ?>

            <?php if (!empty($error_message)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>

            <label for="name" class="nama-produk"><b>Nama Produk</b></label>
            <input class="placeholder-nama" type="text" id="name" name="name" required>

            <label class="nama-produk" for="image"><b>Gambar Produk</b></label>
            <div class="contain-gambar">
                <input type="file" id="image" name="image" accept="image/*" required style="display: none;">
                <div class="cover" onclick="document.getElementById('image').click()">
                    <img class="cover-icon" alt="" src="../img/cover-icon.svg">
                    <div class="upload-cover-foto">Upload gambar</div>
                </div>                    
            </div>

            <label class="nama-produk" for="description"><b>Deskripsi Produk</b></label>
            <textarea class="placeholder-desc" id="description" name="description" required></textarea>

            <label for="category" class="nama-produk"><b>Kategori Produk</b></label>
            <select class="rp-wrapper" id="category" name="category" required>
                <option value="">Pilih Kategori</option>
                <option value="ruangTamu">Ruang Tamu</option>
                <option value="kamarTidur">Kamar Tidur</option>
                <option value="dapur">Dapur</option>
                <option value="kamarMandi">Kamar Mandi</option>
                <option value="outdoor">Outdoor</option>
            </select>

            <label for="price" class="nama-produk"><b>Harga Produk</b></label>
            <input class="rp-wrapper" type="text" id="price" name="price" placeholder="Rp" required pattern="\d+(\.\d{1,2})?">

            <button class="submit">
                <b class="rp">Submit</b>
            </button>
        </form>
    </div>
</body>
</html>