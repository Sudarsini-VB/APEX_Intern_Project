<?php
session_start();
require 'db.php';

if(isset($_POST['register'])){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = 2; // Default user

    $stmt = $conn->prepare("INSERT INTO users (username,email,password,role_id) VALUES (?,?,?,?)");
    $stmt->bind_param("sssi",$username,$email,$password,$role_id);
    if($stmt->execute()){
        header("Location: login.php");
        exit;
    }else{
        $error = "Email already exists or error!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<form method="post" autocomplete="off">

    <h2>Register</h2>
    <input type="text" name="username" placeholder="Username" required autocomplete="off">
    <input type="email" name="email" placeholder="Email" required autocomplete="off">
    <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
    <button type="submit" name="register">Register</button>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</form>
</body>
</html>
