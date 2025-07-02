<?php
session_start();

$host = 'localhost';
$dbname = 'projectrpl';
$username = 'root'; 
$password = '';     

$error_message = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $password = trim($_POST["password"]);

        if (!empty($name) && !empty($password)) {
            $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE name = :name");
            $stmt->execute([':name' => $name]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                header("Location: Home.php");
                exit();
            } else {
                $error_message = "Nama pengguna atau kata sandi tidak valid. Silakan coba lagi.";
            }
        } else {
            $error_message = "Harap isi semua kolom";
        }
    }
} catch (PDOException $e) {
    $error_message = "Database error: " . $e->getMessage();
}
?>
<html>
    <head>
        <title>Sign In</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
        <link href="../css/Sign.css" rel="stylesheet">
        <link href="../img/IKAE.png" rel="icon">
        <title>Sign In</title>
    </head>
<body>
    <div class="container">
        <div class="left">
            <h2>Sign in</h2>
            <?php if ($error_message): ?>
                <p style="color:red;"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>
            <form action="Signin.php" method="post" class="form" autocomplete="off">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input placeholder="Username" type="text" id="name" name="name" required/>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input placeholder="Password" type="password" id="password" name="password" required/>
                </div>
                <button type="submit">Sign in</button>
            </form>
            <p>Belum memiliki akun?</p>
            <a href="Signup.php" style="width: 100%"><button>Sign up</button></a>
        </div>
    </div>
</body>
</html>
