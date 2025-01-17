<?php
session_start();
include('db.php');

//jika login role admin akan kesini
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Menampilkan gambar upload user dan admin
$sql_uploads = "SELECT users.username, image.description, image.image, image.uploaded_by, image.id
                FROM image 
                JOIN users ON image.uploaded_by = users.username";
$result_uploads = $conn->query($sql_uploads);

// Proses search user
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql_search = "SELECT * FROM users WHERE username LIKE '%$search%'";
$result_search = $conn->query($sql_search);

// Proses menambah user
if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql_add_user = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";
    if ($conn->query($sql_add_user) === TRUE) {
        echo "User added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Proses hapus user
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];
    $sql_delete_user = "DELETE FROM users WHERE id = '$user_id'";
    if ($conn->query($sql_delete_user) === TRUE) {
        echo "User deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Proses hapus gambar dan file
if (isset($_GET['delete_id'])) {
    $image_id = $_GET['delete_id'];
    
    // Ambil nama file gambar dari database
    $sql_get_image = "SELECT image FROM image WHERE id = '$image_id'";
    $result_image = $conn->query($sql_get_image);
    
    if ($result_image->num_rows > 0) {
        $row_image = $result_image->fetch_assoc();
        $image_path = 'uploads/' . $row_image['image'];

        // Hapus gambar dari folder uploads jika file ada
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Hapus gambar dari database
        $sql_delete_image = "DELETE FROM image WHERE id = '$image_id'";
        if ($conn->query($sql_delete_image) === TRUE) {
            echo "Image deleted successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
        <!-- Navbar -->
        <div id="navbar">
            <div class="title">
                <a href="admin_dashboard.php" class="logo">Admin Dashboard</a>
            </div>
            <!-- Search Users Section -->
        <div class="search-form">
            <form method="GET" action="admin_dashboard.php">
                <input type="text" name="search" placeholder="Search User" value="<?php echo $search; ?>">
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>
        <div class="loginbar">
        <a href="logout.php" class="logout-button">Logout</a>
        </div>    
        </div>

        <!-- Manage Users Section -->
    <div class="container">
        <div class="manage-users-section">
            <h2>Manage Users</h2>
            <form method="POST" action="admin_dashboard.php">
                <label for="username">Username</label>
                <div class="input-user">
                <input type="text" name="username" required>
                </div>

                <label for="password">Password</label>
                <div class="input-user">
                <input type="password" name="password" required>
                </div>

                <div class="choose">
                <label for="role">Role</label>
                <select name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="add_user">Add User</button>
                </div>
            </form>

            <h3>Existing Users</h3>
            <table>
                <thead>
                    <?php while ($row = $result_search->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                            <td><a href="admin_dashboard.php?delete_user=<?php echo $row['id']; ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </thead>
                <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><a href="">Delete</a></td>
                        </tr>
                </tbody>
            </table>
        </div>

        <!-- Uploads Section (Admin and User Combined) -->
        <div class="manage-users-section">
            <h2>Uploads by Users and Admin</h2>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result_uploads->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo ucfirst($row['uploaded_by']); ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td>
                                <!-- Menampilkan gambar -->
                                <?php if (!empty($row['image']) && file_exists('uploads/' . $row['image'])) { ?>
                                    <img src="uploads/<?php echo $row['image']; ?>" alt="Upload" width="100">
                                <?php } else { ?>
                                    <p>No image available</p>
                                <?php } ?>
                            </td>
                            <td>
                                <!-- Tombol Delete -->
                                <a href="admin_dashboard.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this image?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    
    <footer>
        <p>&copy; 2025 Admin Dashboard. All rights reserved.</p>
    </footer>
</body>
</html>