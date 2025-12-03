<?php
session_start();
include 'connection.php';
$login_message = "";

if (isset($_POST["login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query user record
    $stmt = $conn->prepare("SELECT id FROM users WHERE email=? AND password=?");

    if (!$stmt) {
        die("SQL error: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];  // ← Save user ID for activity logs

        // Redirect to user.php
        header("Location: user.php");
        exit;
    } 
    else {
        $login_message = "Invalid email or password.";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #002d12;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            width: 380px;
            background: rgba(0, 0, 0, 0.35);
            padding: 30px;
            border-radius: 14px;
            text-align: center;
            color: white;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.4);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        .msg {
            margin-bottom: 15px;
            font-size: 14px;
            color: #ffb3b3;
        }

        .input-box {
            width: 100%;
            margin-bottom: 18px;
        }

        input[type=text], 
        input[type=password] {
            width: 100%;
            padding: 13px;
            border-radius: 8px;
            border: none;
            outline: none;
            background: #1b3323;
            color: white;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #1d56ff;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            margin-top: 5px;
        }

        button:hover {
            background: #0f3bd9;
        }
    </style>
</head>

<body>

<div class="login-container">
    <h2>Login</h2>

    <div class="msg"><?= $login_message ?></div>

    <form method="POST">
    <div class="input-box">
        <input type="text" name="email" placeholder="Enter email" required>
    </div>

    <div class="input-box">
        <input type="password" name="password" placeholder="Enter password" required>
    </div>
        <a href="signup.php" style="color:white; font-size:14px; text-decoration:none;">Don't have an account? Sign up</a>
        <br><br>
    <button type="submit" name="login">Login</button>
</form>

</div>

</body>
</html>
