<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkWave Solutions</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container header-container">
            <h1 class="logo">WorkWave Solutions</h1>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="solutions.html">Solutions</a></li>
                    <li><a href="features.html">Features</a></li>
                    <li><a href="testimonials.html">Testimonials</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="user-welcome">👋 Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="member-login.html">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <h2>Welcome to WorkWave Solutions</h2>
        <p>Your go-to platform for work collaboration.</p>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 WorkWave Solutions. All rights reserved.</p>
    </footer>
</body>
</html>
