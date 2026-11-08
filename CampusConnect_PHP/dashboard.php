<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CampusConnect | Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard-wrap">
    <header class="dash-header">
        <div class="brand dark"><span class="brand-icon">✦</span> CampusConnect</div>
        <a class="logout" href="logout.php">Sign Out</a>
    </header>

    <main class="dash-main">
        <p class="eyebrow purple">STUDENT PORTAL</p>
        <h1>Welcome, <?= htmlspecialchars($_SESSION["full_name"]) ?>!</h1>
        <p class="subtitle">You have successfully signed in to your CampusConnect account.</p>

        <section class="dash-cards">
            <article class="dash-card">
                <span>Account status</span>
                <strong class="active-status">Active</strong>
            </article>
            <article class="dash-card">
                <span>Student username</span>
                <strong><?= htmlspecialchars($_SESSION["username"]) ?></strong>
            </article>
        </section>

        <section class="learning-card">
            <h2>My learning space</h2>
            <div class="learning-row"><span>My Classes</span><span class="pill">Ready to view</span></div>
            <div class="learning-row"><span>Announcements</span><span class="pill">Stay updated</span></div>
            <div class="learning-row"><span>Student Profile</span><span class="pill">Account created</span></div>
        </section>
    </main>
</div>
</body>
</html>
