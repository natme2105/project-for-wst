<?php
include "connection.php";

// Fetch tips from database
$tips = [];
$sql = $conn->query("SELECT tip FROM tips ORDER BY id DESC");

while ($row = $sql->fetch_assoc()) {
    $tips[] = $row['tip'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tips</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f0f0f0;
        }

        .topbar {
            width: 100%;
            background: #1e73be;
            padding: 12px 20px;
            color: white;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            background: #26364a;
            padding-top: 20px;
            color: white;
            position: fixed;
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .sidebar a:hover {
            background: #1e2a38;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .tip-item {
            background: #e7e7e7;
            padding: 10px;
            margin-top: 8px;
            border-radius: 3px;
        }
    </style>
</head>
<body>

<div class="topbar">
    <div>Up Cycle: Smart Waste Management & Recycling Monitoring System</div>
    <div>User</div>
</div>

<div class="sidebar">
    <a href="user.php">Home</a>
    <a href="collectionschedule.php">Collection Schedule</a>
    <a href="announcement.php">Announcement</a>
    <a href="tips.php">Tips</a>
    <a href="setting.php">Settings</a>
</div>

<div class="content">
    <div class="card">
        <h2 style="text-align:center;">Tips</h2>

        <?php if (empty($tips)): ?>
            <div class="tip-item">No tips available.</div>
        <?php else: ?>
            <?php foreach ($tips as $tip): ?>
                <div class="tip-item"><?= htmlspecialchars($tip); ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>

</body>
</html>
