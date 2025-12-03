<!DOCTYPE html>
<html>
<head>
    <title>User/Settings</title>
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

        .active {
            background: #1e2a38;
        }

  
        .content {
            margin-left: 220px;
            padding: 20px;
        }

        .settings-container {
            text-align: center;
            margin-top: 50px;
        }

        .settings-container h2 {
            margin-bottom: 30px;
        }

        .settings-btn {
            padding: 10px 20px;
            border: 1px solid #1e73be;
            background: white;
            color: #1e73be;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            font-size: 14px;
        }

        .settings-btn:hover {
            background: #e6f0ff;
        }

        
        .logout-btn {
            position: fixed;
            right: 30px;
            bottom: 30px;
            padding: 10px 20px;
            border: 1px solid #1e73be;
            background: white;
            color: #1e73be;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #e6f0ff;
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
    <a href="collection.php">Collection Schedule</a>
    <a href="announcement.php">Announcement</a>
    <a href="tips.php">Tips</a>
    <a href="settings.php" class="active">Settings</a>
</div>

<div class="content">
    <div class="settings-container">
        <h2>Settings</h2>

        <button class="settings-btn" onclick="location.href='activitylog.php'">Activity Log</button>
        <button class="settings-btn" onclick="location.href='feedback.php'">User Feedback</button>
        <button class="settings-btn" onclick="location.href='user_report.php'">User Report</button>
        <br>
        <button class="settings-btn" onclick="location.href='reward.php'">Reward</button>
    </div>
</div>

<button class="logout-btn" onclick="location.href='logout.php'">Logout</button>

</body>
</html>
