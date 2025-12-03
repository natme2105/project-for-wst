<?php

session_start();
include 'connection.php';


ini_set('display_errors', 1);
error_reporting(E_ALL);


if (!isset($pdo)) {
    die("Database connection not found. Check connection.php");
}


$uploadDir = __DIR__ . '/uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}


if (isset($_POST['submit'])) {
   
    $feedback = isset($_POST['feedback']) ? trim($_POST['feedback']) : '';
    if ($feedback === '') {
        $_SESSION['msg'] = "Feedback cannot be empty.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    $file_name = null;
    if (!empty($_FILES['file']['name'])) {
        $originalName = basename($_FILES['file']['name']);
       
        $safeName = preg_replace('/[^A-Za-z0-9._-]/', '_', $originalName);
        $file_name = time() . '_' . $safeName;

        $targetPath = $uploadDir . '/' . $file_name;

        
        $maxSize = 5 * 1024 * 1024; 
        if ($_FILES['file']['size'] > $maxSize) {
            $_SESSION['msg'] = "File is too large (max 5MB).";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

       
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            $_SESSION['msg'] = "Failed to upload file.";
            $file_name = null;
        }
    }

   
    $stmt = $pdo->prepare("INSERT INTO feedback (message, file) VALUES (?, ?)");
    $stmt->execute([$feedback, $file_name]);

    $_SESSION['msg'] = "Feedback submitted successfully.";
   
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM feedback ORDER BY id DESC");
$stmt->execute();
$feedbackList = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Feedback</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px;}
        .container { max-width: 900px; margin: 0 auto; padding-top: 20px; }
        .card { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.08); }
        textarea { width: 100%; height: 100px; padding: 10px; border-radius: 5px; border: 1px solid #ccc; resize: vertical; }
        .submit-btn { background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; }
        .feedback-item { background: white; padding: 15px; margin-top: 15px; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.05); }
        .file-link { color: #007bff; text-decoration: none; }
        .msg { padding: 10px; margin-bottom: 15px; border-radius: 6px; background: #e9ffe9; color: #064; }
        .err { background: #ffe9e9; color: #640; }
    </style>
</head>
<body>
<div class="container">
    <h2>Feedback</h2>

    <?php if (!empty($_SESSION['msg'])): ?>
        <div class="msg"><?= htmlspecialchars($_SESSION['msg']) ?></div>
        <?php unset($_SESSION['msg']); ?>
    <?php endif; ?>

    <div class="card">
        <form method="POST" enctype="multipart/form-data">
            <h3>Submit Feedback</h3>
            <textarea name="feedback" placeholder="Write your feedback here..." required></textarea>
            <br><br>
            <input type="file" name="file" accept="image/*,.pdf,.txt,.doc,.docx">
            <br><br>
            <button class="submit-btn" name="submit">Submit</button>
        </form>
    </div>

    <h3 style="margin-top:30px;">Submitted Feedback</h3>

    <?php if (empty($feedbackList)): ?>
        <p>No feedback available.</p>
    <?php else: ?>
        <?php foreach ($feedbackList as $fb): ?>
            <div class="feedback-item">
                <p><strong>Feedback:</strong> <?= nl2br(htmlspecialchars($fb['message'])) ?></p>
                <?php if (!empty($fb['file'])): ?>
                    <p><a class="file-link" href="uploads/<?= htmlspecialchars($fb['file']) ?>" target="_blank">View Attachment</a></p>
                <?php endif; ?>
                <small>Submitted at: <?= htmlspecialchars($fb['created_at'] ?? '') ?></small>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>
