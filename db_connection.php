<?php
// db_connection.php

$servername = "localhost"; // Typically "localhost"
$username = "root";        // Your MySQL username
$password = "";            // Your MySQL password
$database = "workwavedb";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // For security reasons, avoid exposing detailed error messages in production
    die("Database connection failed.");
    // For debugging purposes during development, you can uncomment the line below:
    // die("Database connection failed: " . $conn->connect_error);
}
?>
