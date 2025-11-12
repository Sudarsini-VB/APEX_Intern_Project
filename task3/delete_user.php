<?php
session_start();
require 'db.php';
if(!isset($_SESSION['role_id']) || $_SESSION['role_id']!=1) die("Access denied");

if(isset($_GET['id'])){
    $id=intval($_GET['id']);
    $stmt=$conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->close();
}
header("Location: admin_dashboard.php");
exit;
