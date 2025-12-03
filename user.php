<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User | Home</title>

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #d6b0b065;
    }

  
    .topbar {
        background: #f10404ff;
        padding: 10px 20px;
        color: white;
        font-size: 15px;
        display: flex;
        justify-content: space-between;
    }

    
    .sidebar {
        width: 150px;
        background: #2f3b4a;
        height: calc(100vh - 40px);
        padding-top: 15px;
        color: white;
        position: fixed;
        left: 0;
        top: 40px;
    }

    .sidebar a {
        display: block;
        padding: 10px 15px;
        color: white;
        text-decoration: none;
        font-size: 13px;
    }

    .sidebar a:hover {
        background: #415266;
    }

    /* Main Content */
    .content {
        margin-left: 170px;
        padding: 30px;
    }

    h2 {
        margin-bottom: 5px;
    }

    ul {
        margin-top: 10px;
    }

    .desc {
        max-width: 700px;
        font-size: 14px;
        line-height: 1.5;
    }

    .note {
        margin-top: 25px;
        font-size: 12px;
        color: #7d7d7d;
    }
</style>

</head>
<body>


<div class="topbar">
    <div>User / Home</div>
    <div>User</div>
</div>


<div class="sidebar">
    <a href="user.php">Home</a>
    <a href="collectionschedule.php">Collection Schedule</a>
    <a href="announcement.php">Announcement</a>
    <a href="tips.php">Tips</a>
    <a href="setting.php">Settings</a>
</div>
conne

<div class="content">
    <h2>Welcome to Up Cycle: Waste Management & Recycling Monitoring System</h2>

    <p class="desc">
        Welcome to WeCollect, your all-in-one solution for smarter and more efficient waste management. 
        Our system helps communities and administrators streamline their waste collection operations, 
        reduce environmental impact, and promote eco-friendly practices. With WeCollect, you can manage:
    </p>

    <ul>
        <li><b>Collection Schedules:</b> Organize and update waste collection schedules for different areas.</li>
        <li><b>Announcements:</b> Share important updates with the community regarding waste policies and events.</li>
        <li><b>Tips:</b> Provide eco-friendly tips to reduce waste and recycle effectively.</li>
        <li><b>Settings:</b> Customize the system to meet the needs of your community.</li>
    </ul>

    <p class="note">
        Begin managing and optimizing your waste management process with ease and efficiency.
    </p>
</div>

</body>
</html>
