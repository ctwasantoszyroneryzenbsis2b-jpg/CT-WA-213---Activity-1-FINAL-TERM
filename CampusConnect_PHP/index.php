<?php
session_start();
require_once "config.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT id, full_name, username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["full_name"] = $user["full_name"];
        $_SESSION["username"] = $user["username"];
        header("Location: dashboard.php");
        exit;
    } else {
        $errors[] = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CampusConnect | Sign In</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="page">
    <aside class="hero">
        <div class="brand"><span class="brand-icon">✦</span> CampusConnect</div>
        <div>
            <p class="eyebrow">YOUR CAMPUS, ONE PLACE</p>
            <h1>Make every school day count.</h1>
            <p class="hero-text">Sign in to your student portal or create an account to keep your learning journey organized.</p>
        </div>
        <small>© 2026 CampusConnect · Student Portal</small>
    </aside>

    <main class="panel">
        <div class="tabs">
            <a class="active" href="index.php">Sign In</a>
            <a href="register.php">Register</a>
        </div>
        <h2>Welcome back!</h2>
        <p class="subtitle">Sign in with your student account to continue.</p>

        <?php foreach ($errors as $error): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endforeach; ?>

        <form method="POST" action="index.php">
            <label for="username">Student username</label>
            <input id="username" type="text" name="username" placeholder="Enter your username" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Sign In to Portal</button>
        </form>
        <p class="switch-text">New to CampusConnect? <a href="register.php">Create an account</a></p>
    </main>
</div>
</body>
</html>
