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
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <!--<input type="password" name="password" id="password" required placeholder="At least 8 characters, letters & numbers">
        <small class="password-note">Use at least 8 characters, including letters and numbers.</small>-->
    </div>

    <button type="submit" class="btn-action">Login</button>

      <!--<a href="register.php" class="login-register-link">New user? Register here</a>-->
</form>

    <!-- Wrap the link in a div with the new class -->
    <div class="login-register-link">
        <a href="register.php">New user? Register here</a>
    </div>
</div> <!-- Close crud-container -->
</body>
</html>
