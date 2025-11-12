<?php
session_start();
require 'db.php';
if(!isset($_SESSION['role_id']) || $_SESSION['role_id']!=1) die("Access denied");

$result = $conn->query("SELECT u.id,u.username,u.email,r.role_name 
                        FROM users u 
                        JOIN roles r ON u.role_id=r.id");

if(!$result){
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Admin Dashboard</h2>
<a href="index.php" class="button">Back to Dashboard</a>
<a href="logout.php" class="button">Logout</a>

<table>
<tr>
<th>ID</th>
<th>Username</th>
<th>Email</th>
<th>Role</th>
<th>Actions</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['username'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['role_name'] ?></td>
<td>
<a href="edit_profile.php?id=<?= $row['id'] ?>">Edit</a> | 
<a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
