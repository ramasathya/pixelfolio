<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div id="navbar">
        <div class="title">
        <a href="index.php" class="logo">My Portfolio</a>
        </div>
        <div class="search-form">
            <form method="GET" action="home.php">
                <input type="text" name="search" id="search" placeholder="Search">
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>
        <div class="loginbar">
        <span>Welcome,
        <a href="" class="logout-button">Logout</a> <!-- Logout button -->
        </div>
    </div>

    <div class="container">
        <!-- Form untuk upload gambar -->
        <h2>Upload Your Portfolio</h2>
        <div class="upload-section">
            <form action="upload.php" method="POST">
                <input type="text" name="description" placeholder="Enter description" required>
                <input type="file" name="image" required>
                <button type="submit">Upload</button>
            </form>
        </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 My Portfolio Website. All rights reserved.</p>
    </footer>
</body>
</html>
