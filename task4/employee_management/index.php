<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Management CRUD | List Employees</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="style.css">
<style>
*{margin:0;padding:0;}
.navbar{margin:0;}
.mycolor{background: #748EC6;}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mycolor">
    <a class="navbar-brand" href="index.php">Employee Management</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="create-new-employee.php">Add Employee</a></li>
        </ul>
    </div>
</nav>

<div class="container my-5">
    <h2 class="text-center mb-4">List of Employees</h2>
    <a href="create-new-employee.php" class="btn btn-primary mb-3">New Employee</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name </th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // connect to database
        $connection = new mysqli("localhost","root","","php_employee_management");
        if ($connection->connect_error) die("Connection failed: " . $connection->connect_error);

        $result = $connection->query("SELECT * FROM employee");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a href='edit-employee.php?id=$row[id]' class='btn btn-sm btn-primary'>Edit</a>
                        <a href='delete-employee.php?id=$row[id]' class='btn btn-sm btn-danger'>Delete</a>
                    </td>
                </tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
