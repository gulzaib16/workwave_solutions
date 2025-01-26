<?php
// test_session.php
session_start();
$_SESSION['user_id'] = 2; // Replace '1' with a valid user ID from your 'users' table
echo "Session user_id set to " . $_SESSION['user_id'];
?>
