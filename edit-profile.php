<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'workwavedb';

// Database connection
$connection = mysqli_connect($host, $user, $password, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $email = $_POST['email'];

    $update_query = "UPDATE users SET email = '$email' WHERE username = '$username'";
    mysqli_query($connection, $update_query);
    echo "<script>alert('Profile updated successfully!'); window.location.href = 'profile.html';</script>";
}

mysqli_close($connection);
?>
