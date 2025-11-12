<?php
session_start();
require 'db.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id,username,password,role_id FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows>0){
        $stmt->bind_result($id,$username,$hashed_password,$role_id);
        $stmt->fetch();
        if(password_verify($password,$hashed_password)){
            $_SESSION['user_id']=$id;
            $_SESSION['username']=$username;
            $_SESSION['role_id']=$role_id;

            if($role_id==1) header("Location: admin_dashboard.php");
            else header("Location: edit_profile.php");
            exit;
        } else $error="Wrong password";
    } else $error="User not found";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Login</h2>
<?php 
if(isset($_SESSION['message'])) { echo "<p style='color:green'>".$_SESSION['message']."</p>"; unset($_SESSION['message']); }
if(isset($error)) echo "<p style='color:red'>$error</p>"; 
?>
<form method="post" autocomplete="off">
    <h2>Login</h2>

    <!-- Dummy input to trick browser autofill -->
    <input type="text" name="fakeusernameremembered" style="display:none">

    <input type="email" name="email" placeholder="Email" required autocomplete="off">
    
    <!-- Real password input -->
    <input type="password" name="password" placeholder="Password" required autocomplete="new-password">

    <button type="submit" name="login">Login</button>
</form>

<a href="register.php">Register</a>
<script src="js/script.js"></script>
</body>
</html>
