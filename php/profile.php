<?php
session_start();

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
?>
<?php
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
        <?php include "layout/sidebar.php" ?>
        <div class="kiri">
      			<div class="profilku">
        				<img class="profile-pic-icon" alt="" src="img/icontoko.jpg">
        				
        				<div class="hansen-nathaniel-parent">
          					<div class="hansen-nathaniel"><?php echo $user_name; ?></div>
          					<div class="hansennathanielgmailcom"><?php echo $user_email; ?></div>
        				</div>
      			</div>
      			<div class="kiri-child">
      			</div>
      			<div class="identitasku">
        				<div class="nama-parent">
          					<div class="nama">Nama</div>
          					<div class="nama">Tanggal Lahir</div>
          					<div class="nama">Kelamin</div>
          					<div class="nama">Email</div>
          					<div class="nama">Nomor HP</div>
          					<div class="nama">Kota</div>
        				</div>
        				<div class="parent">
          					<b class="b">:</b>
          					<b class="b">:</b>
          					<b class="b">:</b>
          					<b class="b">:</b>
          					<b class="b">:</b>
          					<b class="b">:</b>
        				</div>
        				<div class="hansen-nathaniel-group">
          					<div class="b"><?php echo $user_name; ?></div>
          					<div class="tambah">Tambah</div>
          					<div class="b">Laki-Laki</div>
          					<div class="b"><?php echo $user_email; ?></div>
          					<div class="tambah">Tambah</div>
          					<div class="tambah">Tambah</div>
        				</div>
      			</div>
    		</div>
    </div>
</body>
</html>