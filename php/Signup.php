<?php
session_start();

$host = 'localhost';
$dbname = 'projectrpl';
$username = 'root'; 
$password = '';      

$error_message = '';
$success_message= '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        if (!empty($name) && !empty($email) && !empty($password)) {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            if ($stmt->fetch()) {
                $error_message = "This email is already registered. Please use another email.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':password' => $hashed_password,
                ]);

                $success_message= "Registration successful! You can now log in.";
            }
        } else {
            $error_message = "Please fill in all fields";
        }
    }
} catch (PDOException $e) {
    $error_message = "Database error: " . $e->getMessage();
}
?>
<html>
    <head>
        <title>Sign Up</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
        <link href="../css/Logres.css" rel="stylesheet">
    </head>
<body>
    <div class="container">
        <div class="left">
            <h2>Sign up</h2>
            <?php if ($error_message): ?>
                <p style="color:red;"><?php echo htmlspecialchars($error_message); ?></p>
            <?php elseif ($success_message): ?>
                <p style="color:green; margin-bottom: 15px;"><?php echo htmlspecialchars($success_message); ?></p>
            <?php endif; ?>
            <form action="Signup.php" method="post" class="form" autocomplete="off">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input placeholder="Username" type="text" id="name" name="name" required/>
                </div>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input placeholder="Email" type="email" id="email" name="email" required/>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input placeholder="Password" type="password" id="password" name="password" required/>
                </div>
                <button type="submit">Sign up</button>
            </form>
            <p>Already have an account?</p>
            <a href="Signin.php" style="width: 100%"><button>Sign in</button></a>
        </div>
    </div>
</body>
</html>