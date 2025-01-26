<?php
session_start();
include("db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure database connection is established
    if (!isset($conn)) {
        die("Database connection not established. Check 'db_connection.php'.");
    }

    // Secure input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Prepare and execute query
    $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Registration successful! Please log in.'); window.location.href = 'member-login.html';</script>";
    } else {
        echo "<script>alert('Error: Could not register.');</script>";
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
