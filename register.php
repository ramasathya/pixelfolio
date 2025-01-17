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