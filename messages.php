<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'workwavedb';

// Database connection
$connection = new mysqli($host, $user, $password, $database);
if ($connection->connect_error) {
    die("Database connection failed: " . $connection->connect_error);
}

// Save a new message
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST["message"])) {
        echo "Invalid request.";
        exit();
    }

    $message = trim($_POST["message"]);
    $username = $_SESSION['username'] ?? "Guest"; // Assuming username is stored in session

    if (!empty($message)) {
        $stmt = $connection->prepare("INSERT INTO messages (username, text, sender) VALUES (?, ?, 'user')");
        $stmt->bind_param("ss", $username, $message);
        if ($stmt->execute()) {
            echo "Message saved successfully.";
        } else {
            echo "Error saving message.";
        }
    }
    exit();
}

// Fetch messages
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $query = "SELECT username, text, sender FROM messages ORDER BY created_at DESC LIMIT 20";
    $result = $connection->query($query);
    
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    header("Content-Type: application/json");
    echo json_encode($messages);
    exit();
}
?>
