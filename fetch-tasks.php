<?php
include 'db_connection.php';

$query = "SELECT tasks.id, users.username AS assigned_user, tasks.task, tasks.status 
          FROM tasks 
          JOIN users ON tasks.user_id = users.id";
$result = $conn->query($query);

$tasks = [];
while ($row = $result->fetch_assoc()) {
    $tasks[] = [
        'id' => $row['id'],
        'assigned_user' => $row['assigned_user'],
        'task_name' => $row['task'], // Ensure this is correctly mapped
        'status' => $row['status']
    ];
}

echo json_encode($tasks);
?>
