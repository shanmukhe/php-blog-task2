<?php
session_start();
require 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["user_id"] = $user["id"];
        header("Location: dashboard.php");
    } else {
        echo "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="crud-container"> <!-- Assuming you want the login form in the container -->
    <h2 class="blog-title">Login</h2> <!-- Added blog-title class -->
    <form method="POST">
        <div> <!-- Wrap inputs in div for consistent styling -->
            Username: <input type="text" name="username" required><br>
        </div>
        <div> <!-- Wrap inputs in div for consistent styling -->
            Password: <input type="password" name="password" required><br>
        </div>
        <button type="submit" class="btn-action">Login</button> <!-- Added btn-action class for styling -->

    </form>
    <!-- Wrap the link in a div with the new class -->
    <div class="login-register-link">
        <a href="register.php">New user? Register here</a>
    </div>
</div> <!-- Close crud-container -->
</body>
</html>
