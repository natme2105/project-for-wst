<?php
session_start();

// CONNECT TO DATABASE
$conn = new mysqli("localhost", "root", "", "upcycle_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// INITIALIZE ARRAY
$reports = [];

// FETCH REPORTS
$sql = "SELECT r.*, u.full_name AS username 
        FROM reports r 
        JOIN users u ON r.user_id = u.id
        ORDER BY r.report_id DESC";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $reports = $result->fetch_all(MYSQLI_ASSOC);
}

// HANDLE FORM SUBMISSION
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $report_text = $_POST['report_text'];
    $user_id = 1; // You can change to $_SESSION['user_id'];

    // IMAGE UPLOAD
    $imageName = "No Image";

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir);

        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $imageName;

        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    }

    // INSERT REPORT
    $stmt = $conn->prepare("INSERT INTO reports (user_id, report_text, image, status) VALUES (?, ?, ?, 'Pending')");
    $stmt->bind_param("iss", $user_id, $report_text, $imageName);
    $stmt->execute();

    // REFRESH PAGE
    header("Location: userreport.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>User | Reports</title>
<meta charset="UTF-8">
<style>
/* your CSS here */
</style>
</head>

<body>

<div class="sidebar">
    <a href="user.php">Home</a>
    <a href="collectionschedule.php">Collection Schedule</a>
    <a href="announcement.php">Announcement</a>
    <a href="tips.php">Tips</a>
    <a href="setting.php">Settings</a>
</div>


<div class="topbar"> My Reports </div>

<div class="container">

    <table>
        <tr>
            <th>Report ID</th>
            <th>Username</th>
            <th>Report Text</th>
            <th>Image</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>

        <?php if (!empty($reports)): ?>
            <?php foreach ($reports as $row): ?>
            <tr>
                <td><?= $row['report_id']; ?></td>
                <td><?= $row['username']; ?></td>
                <td><?= $row['report_text']; ?></td>
                <td><?= $row['image']; ?></td>
                <td><?= $row['created_at']; ?></td>
                <td>
                    <span class="status-done"><?= $row['status']; ?></span>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No reports yet.</td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="report-box">
        <h3>Submit Report</h3>
        <form method="POST" enctype="multipart/form-data">
            <textarea name="report_text" placeholder="Describe your problem..."></textarea>
            <br><br>
            <input type="file" name="image"><br><br>
            <button type="submit">Submit</button>
        </form>
    </div>

</div>

</body>
</html>
<style>
    body {
        margin: 0;
        background: #cfcfcf;
        font-family: Arial, sans-serif;
    }

    /* Sidebar */
    .sidebar {
        width: 220px;
        height: 100vh;
        background: #263b5e;
        color: white;
        padding-top: 20px;
        position: fixed;
        left: 0;
        top: 0;
    }

    .sidebar a {
        display: block;
        color: white;
        padding: 14px 20px;
        text-decoration: none;
        font-size: 16px;
    }

    .sidebar a:hover {
        background: #1b2942;
    }

   
    .topbar {
        margin-left: 220px;
        background: #0074d9;
        padding: 12px;
        color: white;
        font-size: 20px;
    }

    
    .container {
        margin-left: 220px;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 25px;
        background: white;
    }

    table th, table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    table th {
        background: #0074d9;
        color: white;
    }

    .status-done {
        background: #28a745;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .status-pending {
        background: #ffc107;
        color: black;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* Form box */
    .report-box {
        width: 70%;
        margin: 0 auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0px 0px 8px #aaa;
    }

    textarea {
        width: 90%;
        height: 100px;
        padding: 10px;
        resize: none;
        font-size: 15px;
    }

    .upload-box {
        margin-top: 14px;
    }

    button {
        background: #0074d9;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background: #005bb5;
    }

</style>
</head>