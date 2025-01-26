<?php
// delete-message.php

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

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET['id'])) {
    echo json_encode(["error" => "Invalid request."]);
    exit();
}

$message_id = intval($_GET['id']);
$user_id = intval($_SESSION['user_id']);

// Verify that the message belongs to the user (receiver)
$check_message = $connection->prepare("SELECT id FROM messages WHERE id = ? AND receiver_id = ?");
$check_message->bind_param("ii", $message_id, $user_id);
$check_message->execute();
$check_message->store_result();

if ($check_message->num_rows === 0) {
    echo json_encode(["error" => "Message not found or access denied."]);
    $check_message->close();
    exit();
}
$check_message->close();

// Delete the message
$delete_message = $connection->prepare("DELETE FROM messages WHERE id = ?");
$delete_message->bind_param("i", $message_id);

if ($delete_message->execute()) {
    echo json_encode(["success" => "Message deleted successfully."]);
} else {
    echo json_encode(["error" => "Failed to delete message: " . $delete_message->error]);
}

$delete_message->close();
$connection->close();
?>
