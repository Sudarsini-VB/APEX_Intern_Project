<?php
$host = "localhost";
$user = "root";       // Default XAMPP user
$pass = "";           // Leave empty for XAMPP
$db   = "portfolio_db";

// Connect & create DB if not exists
$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS $db");
mysqli_select_db($conn, $db);

// Create table if not exists
$table = "CREATE TABLE IF NOT EXISTS contacts(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(150),
  message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $table);
?>
