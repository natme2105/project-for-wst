<?php
include "connection.php";
// Fetch Logs
$sql = "SELECT activity_text, created_at 
        FROM activity_logs 
        WHERE user_id = ?
        ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Activity Log</title>

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #dcdcdc;
    }

    .container {
        margin-left: 260px;
        padding: 20px;
    }

    .title-bar {
        background: #1e90ff;
        padding: 15px;
        color: white;
        font-size: 22px;
        text-align: center;
        font-weight: bold;
    }

    .log-box {
        background: white;
        width: 70%;
        margin: 15px auto;
        padding: 15px;
        border: 2px solid #c0c0c0;
        border-radius: 25px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        box-shadow: 0px 0px 5px #999;
    }

    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        height: 100%;
        width: 240px;
        background: #2b3a55;
        color: white;
        padding-top: 20px;
    }

    .sidebar a {
        display: block;
        padding: 12px 20px;
        font-size: 16px;
        color: white;
        text-decoration: none;
    }

    .sidebar a:hover {
        background: #910909ff;
    }
</style>
</head>

<body>

<!-- LEFT MENU -->
<div class="sidebar">
    <a href="user.php">Home</a>
    <a href="collection.php">Collection Schedule</a>
    <a href="announcements.php">Announcements</a>
     <a href="settings.php" class="active">Settings</a>
</div>

<!-- MAIN -->
<div class="container">

    <div class="title-bar">Activity Log</div>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="log-box">
            <?= htmlspecialchars($row['activity_text']) ?> :
            <?= date("Y-m-d H:i:s", strtotime($row['created_at'])) ?>
        </div>
    <?php endwhile; ?>

</div>

</body>
</html>
