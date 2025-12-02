<?php
session_start();
include "connection.php";

// Example: remove once login sets this
// $_SESSION['full_name'] = "Nathaniel Gutierrez";

// Fetch schedule from database
$schedule = $conn->query("SELECT * FROM collection_schedule");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Collection Schedule</title>

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

    table {
        border-collapse: collapse;
        width: 350px;
        margin: 0 auto;
        background: white;
        font-size: 14px;
    }

    th, td {
        border: 1px solid black;
        padding: 6px;
    }

    th {
        background: #0372d4;
        color: white;
    }
</style>
</head>

<body>

<div class="subheader">
    <?= isset($_SESSION['full_name']) ? strtolower($_SESSION['full_name']) : "user" ?>/Collect
</div>

<div class="header">
    <div>Up Cycle: Smart Waste Management & Recycling Monitoring System</div>
    <div><?= isset($_SESSION['full_name']) ? $_SESSION['full_name'] : "User" ?></div>
</div>

<div class="sidebar">
    <a href="user.php">Home</a>
    <a href="collectionschedule.php" class="active">Collection Schedule</a>
    <a href="announcement.php">Announcement</a>
    <a href="tips.php">Tips</a>
    <a href="settings.php">Settings</a>
</div>

<div class="content">
    <h2>Collection Schedule</h2>

    <table>
        <tr>
            <th>DAY</th>
            <th>Collection</th>
            <th>Time</th>
        </tr>

       <?php
include 'connection.php'; 

$query = "SELECT * FROM schedule_collection";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['day']}</td>
        <td>{$row['collection_status']}</td>
        <td>{$row['collection_time']}</td>
    </tr>";
}
?>
        
    </table>
</div>

</body>
</html>
