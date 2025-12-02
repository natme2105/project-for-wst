<?php
include 'connection.php';
$login_message = "";

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $login_message = "Login successful!";
    } else {
        $login_message = "Invalid username or password.";
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
            <input type="text" name="username" placeholder="Enter username" required>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Enter password" required>
        </div>

        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>
