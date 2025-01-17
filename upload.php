<?php
session_start();
include('db.php');

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_name = $_SESSION['username'];  // Nama pengguna yang login

// Periksa apakah ada file yang diupload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $description = $_POST['description'];
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp = $image['tmp_name'];
    $image_size = $image['size'];
    $image_error = $image['error'];

    // Validasi ekstensi gambar
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

    // Cek jika ekstensi gambar valid
    if (!in_array($image_ext, $allowed_extensions)) {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        exit();
    }

    // Cek jika ada error pada file upload
    if ($image_error !== UPLOAD_ERR_OK) {
        echo "Error uploading file.";
        exit();
    }

    // Cek ukuran file (misalnya, maksimal 5MB)
    $max_size = 5 * 1024 * 1024; // 5MB
    if ($image_size > $max_size) {
        echo "File size must be less than 5MB.";
        exit();
    }

    // Membuat nama file unik
    $unique_name = uniqid('img_') . '.' . $image_ext;
    $target_dir = "uploads/";
    $target_file = $target_dir . $unique_name;

    // Pindahkan gambar ke folder uploads
    if (move_uploaded_file($image_tmp, $target_file)) {
        // Simpan data gambar ke database
        $sql = "INSERT INTO image (description, image, uploaded_by) VALUES ('$description', '$unique_name', '$user_name')";
        if ($conn->query($sql) === TRUE) {
            // Redirect kembali ke home.php setelah sukses
            header('Location: home.php');
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>