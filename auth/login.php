<?php

session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../templates/header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    /** @var PDO $pdo */
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify SHA256 hashed password
    if ($user && hash('sha256', $password) === $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: /index.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<h2 class="mb-4">Login</h2>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="" class="w-50">
    <div class="mb-3">
        <label for="username" class="form-label">Username:</label>
        <input type="text" name="username" id="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Log in</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
