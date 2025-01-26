<?php
session_start();
include("db_connection.php");

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    die("❌ No user session found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $old_password = trim($_POST['old_password']);
    $new_password = trim($_POST['new_password']);

    // Fetch current password hash from the database
    $query = "SELECT password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        die("❌ User not found in database.");
    }

    // Debugging: Show stored hash before change
    echo "🔍 Stored Hash Before Change: " . $user['password'] . "<br>";

    // Verify the old password
    if (!password_verify($old_password, $user['password'])) {
        die("❌ Incorrect old password.");
    }

    // Hash the new password
    $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Debugging: Show new hash before updating database
    echo "✅ New Hashed Password: " . $new_hashed_password . "<br>";

    // Update the password in the database
    $update_query = "UPDATE users SET password = ? WHERE username = ?";
    $update_stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($update_stmt, "ss", $new_hashed_password, $username);
    $success = mysqli_stmt_execute($update_stmt);

    if ($success) {
        echo "<script>alert('✅ Password updated successfully!'); window.location.href = 'dashboard.html';</script>";
    } else {
        die("❌ Error updating password: " . mysqli_error($connection));
    }

    mysqli_stmt_close($update_stmt);
    mysqli_close($connection);
}
?>