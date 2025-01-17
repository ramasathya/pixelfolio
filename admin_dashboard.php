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
        <a href="" class="logout-button">Logout</a>
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
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <!-- Tombol Delete -->
                                <a href="">Delete</a>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>

    </div>
    
    <footer>
        <p>&copy; 2025 Admin Dashboard. All rights reserved.</p>
    </footer>
</body>
</html>