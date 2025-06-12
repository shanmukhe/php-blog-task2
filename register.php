<?php
// Assuming your register.php starts with PHP processing like the snippet you shared
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form submission
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $dob = $_POST["dob"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Basic validation (you should add more robust validation)
    if (!empty($name) && !empty($username) && !empty($email) && !empty($mobile) && !empty($dob) && !empty($age) && !empty($gender) && !empty($_POST["password"])) {
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, username, email, mobile, dob, age, gender, password)
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $username, $email, $mobile, $dob, $age, $gender, $password]);

            // Redirect or show success message
            echo "<p class='success-message'>Registered successfully! <a href='login.php'>Login</a></p>";
        } catch (PDOException $e) {
            // Handle database errors (e.g., duplicate username/email)
            echo "<p class='error-message'>Error during registration: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p class='error-message'>Please fill in all required fields.</p>";
    }
}
?>

<?php include 'header.php'; // Include your header which links to style.css ?>

<div class="crud-container">
    <h2 class="blog-title">Register New Account</h2>

    <!-- The HTML form with all required fields -->
    <form action="register.php" method="post">
        <div>
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="mobile">Mobile Number:</label>
            <input type="text" id="mobile" name="mobile" required>
        </div>

        <div>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
        </div>

        <div>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required min="1">
        </div>

        <div>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <!-- Note: You might want JavaScript to check if password and confirm_password match -->
        </div>

        <button type="submit" class="btn-action">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</div>

<?php include 'footer.php'; // Include your footer ?>
