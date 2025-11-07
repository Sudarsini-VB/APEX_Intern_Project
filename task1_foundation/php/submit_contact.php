<?php
// ✅ Show all errors to debug easily
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio_db";

// ✅ Connect to MySQL (no DB yet)
$conn = new mysqli($servername, $username, $password);

// ✅ Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Create database if not exists
if (!$conn->query("CREATE DATABASE IF NOT EXISTS $dbname")) {
    die("Database creation failed: " . $conn->error);
}

// ✅ Select database
$conn->select_db($dbname);

// ✅ Create contacts table if not exists
$table_sql = "CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!$conn->query($table_sql)) {
    die("Table creation failed: " . $conn->error);
}

// ✅ Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>DEBUG: POST data received\n";
    print_r($_POST);
    echo "</pre>";

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $insert = "INSERT INTO contacts (name, email, message)
               VALUES ('$name', '$email', '$message')";

    if ($conn->query($insert) === TRUE) {
        echo "<script>
                alert('Message sent successfully!');
                window.location.href='../index.html';
              </script>";
    } else {
        echo "Insert failed: " . $conn->error;
    }
}


$conn->close();
?>
