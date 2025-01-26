<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die(json_encode(["error" => "Invalid request method."]));
}

$task_id = $_POST['task_id'] ?? null;

if (!$task_id) {
    die(json_encode(["error" => "Task ID is required."]));
}

$sql = "DELETE FROM tasks WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $task_id);
$stmt->execute();

echo json_encode(["success" => true, "message" => "Task deleted successfully"]);
?>
