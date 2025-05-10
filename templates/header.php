<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

<!-- Navbar -->
<nav class="d-flex justify-content-between align-items-center mb-4">
    <h2>📰 News Site</h2>

    <div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <span class="me-2">Hello, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
            <a href="/auth/logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
        <?php else: ?>
            <a href="/auth/login.php" class="btn btn-outline-primary btn-sm">Login</a>
        <?php endif; ?>
    </div>
</nav>
