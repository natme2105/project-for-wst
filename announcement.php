<?php
session_start();
include 'connection.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Announcement</title>

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #dcdcdc;
    }

    .header {
        background: #0078ff;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .subheader {
        background: #bfbfbf;
        color: #333;
        padding: 5px 15px;
        font-size: 14px;
    }

    .sidebar {
        width: 200px;
        background: #2e3b4e;
        height: calc(100vh - 52px);
        position: fixed;
        top: 52px;
        left: 0;
        padding-top: 10px;
        color: white;
    }

    .sidebar a {
        display: block;
        padding: 12px 18px;
        text-decoration: none;
        color: white;
        font-size: 14px;
    }

    .sidebar a.active {
        background: #415266;
    }

    .sidebar a:hover {
        background: #4e6077;
    }

    .content {
        margin-left: 220px;
        padding: 30px;
        text-align: center;
    }

    .box {
        width: 70%;
        margin: 0 auto;
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 8px rgba(0,0,0,0.2);
        text-align: left;
    }

    .announcement {
        background: #efefef;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 3px;
        font-size: 14px;
    }
</style>
</head>

<body>

<div class="subheader">
    <?= isset($_SESSION['full_name']) ? strtolower($_SESSION['full_name']) : "user" ?>/Announcement
</div>

<div class="header">
    <div>Up Cycle: Smart Waste Management & Recycling Monitoring System</div>
    <div><?= isset($_SESSION['full_name']) ? $_SESSION['full_name'] : "User" ?></div>
</div>

<div class="sidebar">
    <a href="user.php">Home</a>
    <a href="collectionschedule.php">Collection Schedule</a>
    <a href="announcement.php" class="active">Announcement</a>
    <a href="tips.php">Tips</a>
    <a href="settings.php">Settings</a>
</div>

<div class="content">
    <h2>Announcements</h2>

    <div class="box">
        <?php
        $query = "SELECT * FROM announcements ORDER BY id DESC";
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "<div class='announcement'>{$row['message']}</div>";
        }
        ?>
    </div>
</div>

</body>
</html>
