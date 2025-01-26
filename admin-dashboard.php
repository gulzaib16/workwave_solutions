<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: member-login.html"); // Redirect non-admin users
    exit();
}
?>
