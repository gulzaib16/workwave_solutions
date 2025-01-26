<?php
// fetch-users.php

// Set the response content type to JSON
header('Content-Type: application/json');

// Include the database connection file
require 'db_connection.php';

// Optional: Start session if you need to verify admin privileges
// session_start();

// Optional: Verify if the user is authorized (e.g., is an admin)
// Uncomment and modify the following lines based on your authentication logic
/*
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(["error" => "Unauthorized access."]);
    exit();
}
*/

// Prepare the SQL query to fetch user details
$query = "SELECT id, username, email FROM users";

// Execute the query
$result = $conn->query($query);

// Initialize an array to hold user data
$users = [];

// Check if the query was successful
if ($result) {
    // Fetch each user as an associative array and add it to the $users array
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    // Return the user data as a JSON response
    echo json_encode($users);
} else {
    // If there's an error executing the query, return an error message
    // For development purposes, include the error message
    // For production, use a generic error message to avoid exposing sensitive information

    // Development Mode:
    // echo json_encode(["error" => "Failed to fetch users: " . $conn->error]);

    // Production Mode:
    echo json_encode(["error" => "Failed to fetch users. Please try again later."]);
}

// Close the database connection
$conn->close();
?>
