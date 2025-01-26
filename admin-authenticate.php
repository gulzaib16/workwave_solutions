<?php
session_start();
include 'db_connection.php'; // Ensure this file exists and defines $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Fetch user credentials
    $stmt = $conn->prepare("SELECT id, password, is_admin FROM users WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password, $is_admin);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;

                // Redirect to Admin Dashboard if admin, otherwise to User Dashboard
                if ($is_admin == 1) {
                    $_SESSION['admin'] = true;
                    header("Location: admin-dashboard.html");
                } else {
                    $_SESSION['admin'] = false;
                    header("Location: dashboard.html");
                }
                exit();
            } else {
                echo "<script>alert('Invalid password!'); window.location.href = 'admin-login.html';</script>";
            }
        } else {
            echo "<script>alert('Invalid username!'); window.location.href = 'admin-login.html';</script>";
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
?>