<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'workwavedb';

// Database connection
$connection = new mysqli($host, $user, $password, $database);
if ($connection->connect_error) {
    die("Database connection failed: " . $connection->connect_error);
}

// Fetch tasks
$query = "SELECT id, text FROM tasks ORDER BY created_at DESC";
$result = $connection->query($query);

$tasks = [];
while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

header("Content-Type: application/json");
echo json_encode($tasks);
?>
