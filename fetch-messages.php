<?php
// fetch-messages.php

session_start();
header('Content-Type: application/json');
require 'db_connection.php';

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in."]);
    exit();
}

$user_id = intval($_SESSION['user_id']);

// Prepare the SQL statement to prevent SQL injection
$sql = "SELECT messages.id, users.username AS sender, messages.message, messages.timestamp 
        FROM messages 
        JOIN users ON messages.sender_id = users.id
        WHERE messages.receiver_id = ?
        ORDER BY messages.timestamp DESC";

$stmt = $connection->prepare($sql);
if (!$stmt) {
    echo json_encode(["error" => "Prepare failed: " . $connection->error]);
    exit();
}

$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();

$messages = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    echo json_encode($messages);
} else {
    echo json_encode(["error" => "Failed to fetch messages: " . $connection->error]);
}

$stmt->close();
$connection->close();
?>
