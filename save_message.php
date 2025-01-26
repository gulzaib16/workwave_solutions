<?php
session_start();
include "db_connection.php"; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_id = $_SESSION["user_id"];
    $receiver_id = $_POST["receiver_id"];
    $message = $_POST["message"];

    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Message sent successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error sending message"]);
    }
    $stmt->close();
    $conn->close();
}
?>
