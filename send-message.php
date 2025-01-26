<?php
// send-message.php

session_start();
header('Content-Type: application/json');
require 'db_connection.php';

// For testing purposes, set the user_id manually if not set
// Remove or secure this in production
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 2; // Replace with a valid user ID from your 'users' table
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error" => "Invalid request method."]);
    exit();
}

// Get the raw POST data
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['message']) || !isset($data['receiver_id'])) {
    echo json_encode(["error" => "Missing required fields: message and receiver_id."]);
    exit();
}

$message = trim($data['message']);
$receiver_id = intval($data['receiver_id']);
$sender_id = intval($_SESSION['user_id']);

// Validate input
if (empty($message)) {
    echo json_encode(["error" => "Message cannot be empty."]);
    exit();
}

// Check if receiver exists
$check_receiver = $connection->prepare("SELECT id FROM users WHERE id = ?");
$check_receiver->bind_param("i", $receiver_id);
$check_receiver->execute();
$check_receiver->store_result();

if ($check_receiver->num_rows === 0) {
    echo json_encode(["error" => "Receiver does not exist."]);
    $check_receiver->close();
    exit();
}
$check_receiver->close();

// Insert the message
$insert_message = $connection->prepare("INSERT INTO messages (sender_id, receiver_id, message, timestamp) VALUES (?, ?, ?, NOW())");
$insert_message->bind_param("iis", $sender_id, $receiver_id, $message);

if ($insert_message->execute()) {
    echo json_encode(["success" => "Message sent successfully."]);
} else {
    echo json_encode(["error" => "Failed to send message: " . $insert_message->error]);
}

$insert_message->close();
$connection->close();
?>
