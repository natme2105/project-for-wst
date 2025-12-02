<?php
include "connection.php";

$register_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = $_POST['full_name'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];
    $confirm   = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $register_message = "❌ Passwords do not match.";
    } else {
        
        $hashed = password_hash($password, PASSWORD_DEFAULT);

      
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $full_name, $email, $hashed);


        if ($stmt->execute()) {
            echo "<script>alert('Account created successfully!'); window.location='login.php';</script>";
            exit();
        } else {
            $register_message = "❌ Email already exists.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Account</title>

<style>
body {
    margin: 0;
    font-family: Arial;
    background: #002d12;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 430px;
    background: rgba(0,0,0,0.35);
    padding: 30px;
    border-radius: 14px;
    color: white;
    box-shadow: 0px 0px 20px rgba(0,0,0,0.4);
}

.logo {
    text-align: center;
    margin-bottom: 15px;
}

.logo-box {
    width: 35px;
    height: 35px;
    background: #3454ff;
    margin: 0 auto 5px auto;
    border-radius: 8px;
}

input[type=text], input[type=email], input[type=password] {
    width: 100%;
    padding: 13px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: none;
    background: #1b3323;
    color: white;
}

button {
    width: 100%;
    padding: 14px;
    background: #1d56ff;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    margin-top: 10px;
}

small {
    font-size: 12px;
    text-align: center;
    display: block;
    margin-top: 10px;
    opacity: .8;
}

.msg {
    text-align: center;
    margin-bottom: 10px;
    font-size: 14px;
    color: #ff8a8a;
}
</style>
</head>

<body>

<div class="container">

    <div class="logo">
        <div class="logo-box"></div>
        <h3>Up Cycle</h3>
    </div>

    <h2 style="text-align:center;">Create Account</h2>
    <p style="text-align:center; margin-bottom:25px;">Join Up Cycle to start monitoring waste and recycling</p>

    <div class="msg"><?= $register_message ?></div>

    <form method="POST">

        <label>Full Name</label>
        <input type="text" name="full_name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="confirm_password" required>

        <label>
            <input type="checkbox" required> I agree to the terms
        </label>

        <button type="submit">Create account</button>

        <small>By creating an account, you agree to our Terms of Service and Privacy Policy.</small>

    </form>

</div>

</body>
</html>
