<?php
session_start();
include('db.php');


// Proses pencarian gambar berdasarkan deskripsi
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql_search = "SELECT * FROM image WHERE description LIKE '%$search%'";
$result_search = $conn->query($sql_search);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixelfolio</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Navbar -->
    <div id="navbar">
        <div class="title">
        <a href="index.php" class="logo">Pixelfolio</a>
        </div>
        <div class="search-form">
            <form method="GET" action="index.php">
                <input type="text" name="search" id="search" placeholder="Search" value="">
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>
        <div class="loginbar">
            <?php if (isset($_SESSION['user_id'])) { ?>
                <!-- Jika sudah login -->
                <a href="home.php" class="user-name"><?php echo $_SESSION['username']; ?></a>
                <a href="logout.php" class="logout-button">Logout</a>
            <?php } else { ?>
                <!-- Jika belum login -->
                <a href="login.php" class="logbutton">Login</a>
                <a href="register.php" class="logbutton">Register</a>
            <?php } ?>
        </div>
    </div>

        <!-- welcome -->
        <div class="welcome">
    <div class="carousel-container">
        <!-- Carousel -->
        <div class="carousel">
            <div class="carousel-slide">
                <img src="images/slide1.png" alt="Slide 1">
            </div>
            <div class="carousel-slide">
                <img src="images/slide2.png" alt="Slide 2">
            </div>
            <div class="carousel-slide">
                <img src="images/slide3.png" alt="Slide 3">
            </div>
        </div>
        <!-- Text Overlay -->
        <div class="carousel-text">
            <h1>PIXELFOLIO</h1>
            <p>Find Picture Suited For You</p>
        </div>
    </div>
</div>

    <!-- Image Gallery Section -->
    <div class="container">
        <h2>Image Gallery</h2>
        <div class="portfolio-items">
            <?php while ($row = $result_search->fetch_assoc()) { ?>
                <div class="portfolio-item">
                    <!-- Gambar dan deskripsi -->
                    <img src="uploads/<?php echo $row['image']; ?>" alt="Image" />
                    <p><?php echo $row['description']; ?></p>
                    <p><strong>Uploaded by:</strong> <?php echo $row['uploaded_by']; ?></p>
                    <a href="uploads/<?php echo $row['image']; ?>" download>Download</a>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 My Portfolio Website. All rights reserved.</p>
    </footer>

    <script src="javascript/script.js"></script>
</body>
</html>

</body>