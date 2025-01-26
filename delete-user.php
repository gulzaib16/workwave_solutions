<?php
// fetch-users.php

header('Content-Type: application/json');
require 'db_connection.php';

// Fetch all users
$sql = "SELECT id, username, email FROM users";
$result = $connection->query($sql);

$users = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
} else {
    echo json_encode(["error" => "Failed to fetch users: " . $connection->error]);
}

$connection->close();
?>
