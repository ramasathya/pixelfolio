<?php
session_start();
include('db.php');

// Cek apakah form register telah disubmit
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert ke database
        $sql_register = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', 'user')";
        if ($conn->query($sql_register) === TRUE) {
            header('Location: login.php'); // Redirect ke halaman login setelah berhasil
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    } else {
        $error = "Passwords do not match!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <!-- Register Form -->
    <div class="login-container">
        <h2>Create an Account</h2>
        <form method="POST" action="register.php">
        <div class="input-group">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>
        <div class="input-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required>
        </div>
            <button type="submit" name="register">Register</button>
            <a class="back" href="index.php">Back</a>
        </form>

    </div>

</body>
</html>