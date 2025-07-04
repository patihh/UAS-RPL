<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_logout'])) {

    session_unset();
    session_destroy();
    header("Location: Signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="../css/styleLogout.css">
    <link href="../img/IKAE.png" rel="icon">
    <title>Logout</title>
</head>
<body>
    <div class="popup-container">
        <div class="popup">
            <h2>Are you sure you want to log out?</h2>
            <form method="POST">
                <button type="submit" name="confirm_logout" class="btn-confirm">Yes, Log Out</button>
                <a href="profile.php" class="btn-cancel">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
