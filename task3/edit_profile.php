<?php
session_start();
require 'db.php';
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$user_id = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['user_id'];

if(isset($_POST['update'])){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['size']>0){
        $profile_pic = "uploads/".basename($_FILES['profile_pic']['name']);
        move_uploaded_file($_FILES['profile_pic']['tmp_name'],$profile_pic);
        $stmt = $conn->prepare("UPDATE users SET username=?, email=?, profile_pic=? WHERE id=?");
        $stmt->bind_param("sssi",$username,$email,$profile_pic,$user_id);
    }else{
        $stmt = $conn->prepare("UPDATE users SET username=?, email=? WHERE id=?");
        $stmt->bind_param("ssi",$username,$email,$user_id);
    }
    $stmt->execute();
    $stmt->close();
    $_SESSION['username']=$username;
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT username,email,profile_pic FROM users WHERE id=?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$stmt->bind_result($username,$email,$profile_pic);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Profile</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<form method="post" enctype="multipart/form-data">
<h2>Edit Profile</h2>
<input type="text" name="username" value="<?= $username ?>" required>
<input type="email" name="email" value="<?= $email ?>" required>
<input type="file" name="profile_pic" accept="image/*">
<?php if($profile_pic): ?>
<img src="<?= $profile_pic ?>" width="80">
<?php endif; ?>
<button type="submit" name="update">Update Profile</button>
</form>
</body>
</html>
