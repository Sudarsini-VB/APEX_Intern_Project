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

$name = $email = $phone = $address = "";
$errorMessage = $successMessage = "";

// POST request: add new employee
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All fields are required!";
            break;
        }

        // Use prepared statement to prevent SQL injection
        $stmt = $connection->prepare("INSERT INTO employee (name, email, phone, address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $address);
        $result = $stmt->execute();

        if (!$result) {
            $errorMessage = "Error adding employee: " . $connection->error;
            break;
        }

        $successMessage = "Employee Added Successfully!";
        header("location: index.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Management CRUD | New Employee</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
*{margin:0;padding:0;}
.navbar{margin:0;}
.error {color: red;font-style: italic;}
.mycolor{background: #748EC6;}
.section-bg {background-color: #f2f5fa;padding:0;margin:0;}
.card-shadow{background-color:#fff;border-radius:10px;box-shadow:0px 5px 20px rgba(0,0,0,0.1);padding:30px;}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mycolor">
    <a class="navbar-brand" href="index.php">Employee Management</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item active"><a class="nav-link" href="create-new-employee.php">Add Employee</a></li>
        </ul>
    </div>
</nav>

<div class="container my-5">
    <h2 class="text-center mb-5">New Employee</h2>

    <?php if(!empty($errorMessage)): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?= $errorMessage ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?= $name ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" value="<?= $email ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" value="<?= $phone ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="<?= $address ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a href="index.php" class="btn btn-outline-secondary" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>

</body>
</html>
