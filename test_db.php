<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "workwavedb";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("❌ Database Connection Failed: " . $connection->connect_error);
} else {
    echo "✅ Database Connected Successfully!";
}

// Close connection
$connection->close();
?>
