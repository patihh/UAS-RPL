<?php
session_start();

// Koneksi DB tetap digunakan jika ingin
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

// Simpan biodata dari form ke session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['tanggal_lahir'] = $_POST['tanggal_lahir'] ?? '';
    $_SESSION['jenis_kelamin'] = $_POST['jenis_kelamin'] ?? '';
    $_SESSION['no_hp'] = $_POST['no_hp'] ?? '';
}

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    $stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = :id");
    $stmt->execute([':id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $user_name = htmlspecialchars($user['name']);
        $user_email = htmlspecialchars($user['email']);
    } else {
        $user_name = "Unknown";
        $user_email = "Unknown";
    }
} else {
    $user_name = "Guest";
    $user_email = "Not logged in";
}

// Ambil data dari session jika ada
$tanggal_lahir = $_SESSION['tanggal_lahir'] ?? null;
$jenis_kelamin = $_SESSION['jenis_kelamin'] ?? null;
$no_hp = $_SESSION['no_hp'] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="styleProfile.css" />
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" />
  	<link rel="stylesheet" href="styles/sidebar.css" />
</head>
<body class="profile-page">
    <?php include "layout/header.html"?>
    <div class="profile">
        <div class="kiri">
			<?php include "layout/sidebar.php" ?>
            <div class="profile-container">
                <!-- FOTO PROFIL -->
                <div class="profile-picture-box">
                    <img src="img/icontoko.jpg" alt="Foto Profil">
                    <p class="upload-info">
                      Besar file: maksimum 10.000.000 bytes (10 MB). <br>
                      Ekstensi file yang diperbolehkan: JPG, JPEG, PNG
                    </p>
                </div>

                <!-- DETAIL PROFIL -->
                <div class="profile-details">
                    <form method="POST" class="profile-section">
                        <h3>Biodata Diri</h3>

                        <div class="profile-field">
                            <div class="label">Nama</div>
                            <div class="value">
                                <?php echo $user_name; ?>
                            </div>
                        </div>

                        <div class="profile-field">
                            <div class="label">Tanggal Lahir</div>
                            <div class="value">
                                <input type="date" name="tanggal_lahir" value="<?php echo htmlspecialchars($tanggal_lahir); ?>" />
                            </div>
                        </div>

                        <div class="profile-field">
                            <div class="label">Jenis Kelamin</div>
                            <div class="value">
                                <select name="jenis_kelamin">
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-Laki" <?php if ($jenis_kelamin == "Laki-Laki") echo 'selected'; ?>>Laki-Laki</option>
                                    <option value="Perempuan" <?php if ($jenis_kelamin == "Perempuan") echo 'selected'; ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <h3>Kontak</h3>

                        <div class="profile-field">
                            <div class="label">Email</div>
                            <div class="value">
                                <?php echo $user_email; ?>
                                <span class="verification-badge">Terverifikasi</span>
                            </div>
                        </div>

                        <div class="profile-field">
                            <div class="label">Nomor HP</div>
                            <div class="value">
                                <input type="text" name="no_hp" value="<?php echo htmlspecialchars($no_hp); ?>" placeholder="Tambah Nomor HP" />
                            </div>
                        </div>

                        <button type="submit" class="save-btn">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
