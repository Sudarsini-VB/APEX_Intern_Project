<?php
// connect to database
$servername = "localhost";
$username = "root";
$password = "";
$database = "php_employee_management";

// Create Connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if 'id' parameter is set
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Prepare statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM employee WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Redirect back to index page
header("location: index.php");
exit;
?>
