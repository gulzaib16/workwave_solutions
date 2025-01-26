<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die(json_encode(["error" => "Invalid request method."]));
}

$task_name = isset($_POST['task_name']) ? trim($_POST['task_name']) : "";
$user_id = isset($_POST['user_id']) && $_POST['user_id'] !== "" ? intval($_POST['user_id']) : NULL;

if (empty($task_name)) {
    die(json_encode(["error" => "Task name is required."]));
}

$sql = "INSERT INTO tasks (task, user_id, status) VALUES (?, ?, 'pending')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $task_name, $user_id);
$stmt->execute();

echo json_encode(["success" => true, "message" => "Task added successfully"]);
?>
