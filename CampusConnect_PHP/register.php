<?php
require_once "config.php";

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";
    $password2 = $_POST["password2"] ?? "";

    if ($full_name === "" || $username === "" || $password === "" || $password2 === "") {
        $errors[] = "Please complete all fields.";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    } elseif ($password !== $password2) {
        $errors[] = "Passwords should match.";
    } else {
        $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $check->execute([$username]);

        if ($check->fetch()) {
            $errors[] = "That username is already registered.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare(
                "INSERT INTO users (full_name, username, password) VALUES (?, ?, ?)"
            );
            $stmt->execute([$full_name, $username, $hashed_password]);
            $success = "Registration successful! You can now sign in.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CampusConnect | Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="page">
    <aside class="hero">
        <div class="brand"><span class="brand-icon">✦</span> CampusConnect</div>
        <div>
            <p class="eyebrow">YOUR CAMPUS, ONE PLACE</p>
            <h1>Start your campus journey.</h1>
            <p class="hero-text">Create your student account and get ready to access your campus space.</p>
        </div>
        <small>© 2026 CampusConnect · Student Portal</small>
    </aside>

    <main class="panel">
        <div class="tabs">
            <a href="index.php">Sign In</a>
            <a class="active" href="register.php">Register</a>
        </div>
        <h2>Create your account</h2>
        <p class="subtitle">Enter your details to register with CampusConnect.</p>

        <?php foreach ($errors as $error): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endforeach; ?>
        <?php if ($success): ?>
            <div class="alert success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <label for="full_name">Full name</label>
            <input id="full_name" type="text" name="full_name" placeholder="Enter your full name" required>

            <label for="username">Student username</label>
            <input id="username" type="text" name="username" placeholder="Choose a username" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="At least 6 characters" required>

            <label for="password2">Confirm password</label>
            <input id="password2" type="password" name="password2" placeholder="Re-enter your password" required>

            <button type="submit">Create Account</button>
        </form>
        <p class="switch-text">Already registered? <a href="index.php">Sign in</a></p>
    </main>
</div>
</body>
</html>
