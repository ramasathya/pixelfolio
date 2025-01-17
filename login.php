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