<?php
session_start();
include("db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure database connection is established
    if (!isset($conn)) {
        die("Database connection not established. Check 'db_connection.php'.");
    }

    // Secure user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = trim($_POST['password']);

    // Prepare and execute query
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Debugging: Show stored hash before verifying password
        echo "🔍 Stored Hash During Login: " . $user['password'] . "<br>";

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            echo "<script>
                sessionStorage.setItem('username', '{$user['username']}');
                window.location.href = 'dashboard.html';
            </script>";
            exit();
        } else {
            die("❌ Password does not match!");
        }
    } else {
        die("❌ Invalid username!");
    }
}

// Close connection
mysqli_close($conn);
?>
