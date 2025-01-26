<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die(json_encode(["error" => "Invalid request method."]));
}

$task_id = $_POST['task_id'] ?? null;
$task_name = $_POST['task_name'] ?? null;

if (!$task_id || !$task_name) {
    die(json_encode(["error" => "Missing task ID or task name."]));
}

$sql = "UPDATE tasks SET task = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $task_name, $task_id);
$stmt->execute();

echo json_encode(["success" => true, "message" => "Task updated successfully"]);
?>
