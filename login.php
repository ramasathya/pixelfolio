<?php
session_start();
include('db.php');

// Cek apakah form login telah disubmit
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User ditemukan, cek password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password benar, set session dan redirect berdasarkan role
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role']; // Menyimpan role di session
            
            // Redirect berdasarkan role
            if ($row['role'] == 'admin') {
                header('Location: admin_dashboard.php'); // Arahkan ke halaman admin_dashboard.php untuk admin
            } else {
                header('Location: home.php'); // Arahkan ke halaman home untuk user biasa
            }
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <!-- Login Form -->
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" name="login" class="btn-submit">Login</button>
            <a class="back" href="index.php">Back</a>
        </form>

    </div>

</body>
</html>