<?php
session_start();
include('db.php');

// Ambil nama user yang login
$user_name = $_SESSION['username'];  // Pastikan sudah ada dalam session

// Proses pencarian gambar
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM image WHERE description LIKE '%$search%' AND uploaded_by = '$user_name'";
$result = $conn->query($sql);
?>

?>

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
        <span>Welcome, <?php echo $user_name; ?></span> <!-- Menampilkan nama user-->
        <a href="logout.php" class="logout-button">Logout</a> <!-- Logout button -->
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
        
        <h2>Your Portfolio</h2>
        <div class="portfolio-items">
            <?php while($row = $result->fetch_assoc()) { ?>
                <div class="portfolio-item">
                    <!-- Pastikan path gambar benar -->
                    <img src="uploads/<?php echo $row['image']; ?>" alt="Image" width="300">
                    <p><?php echo $row['description']; ?></p>
                </div>
            <?php } ?>
        </div>

    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 My Portfolio Website. All rights reserved.</p>
    </footer>
</body>
</html>
