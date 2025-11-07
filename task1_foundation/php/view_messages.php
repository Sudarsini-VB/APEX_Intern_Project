<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ Check login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// ✅ Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM contacts WHERE id=$delete_id");
    echo "<script>alert('Message deleted successfully!'); window.location.href='view_messages.php';</script>";
    exit;
}

// ✅ Fetch all messages
$sql = "SELECT * FROM contacts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Message Viewer | Sudarsini Portfolio</title>
<style>
  body {
    font-family: "Poppins", sans-serif;
    background: linear-gradient(135deg, #1e293b, #0f172a);
    color: #f8fafc;
    text-align: center;
    padding: 20px;
  }
  h1 {
    color: #38bdf8;
    margin-bottom: 20px;
  }
  table {
    width: 90%;
    margin: 0 auto;
    border-collapse: collapse;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
  }
  th, td {
    padding: 12px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }
  th {
    background: rgba(56, 189, 248, 0.2);
    color: #facc15;
  }
  tr:hover {
    background: rgba(56, 189, 248, 0.1);
  }
  .delete-btn {
    background: #ef4444;
    color: white;
    padding: 6px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.3s;
  }
  .delete-btn:hover {
    background: #dc2626;
  }
  .no-msg {
    margin-top: 30px;
    color: #94a3b8;
  }
  a.back {
    display: inline-block;
    margin-top: 25px;
    padding: 10px 18px;
    background: #38bdf8;
    color: #0f172a;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
  }
  a.back:hover {
    background: #facc15;
  }
</style>
</head>
<body>

<h1>📬 Contact Messages</h1>

<?php if ($result->num_rows > 0): ?>
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Message</th>
      <th>Received At</th>
      <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['message']) ?></td>
        <td><?= $row['created_at'] ?></td>
        <td>
          <a href="view_messages.php?delete_id=<?= $row['id'] ?>" 
             onclick="return confirm('Are you sure you want to delete this message?');">
             <button class="delete-btn">Delete</button>
          </a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
<?php else: ?>
  <p class="no-msg">No messages received yet 😇</p>
<?php endif; ?>

<a href="../index.html" class="back">← Back to Portfolio</a>
<br>
<a href="logout.php" class="back">Logout</a>

</body>
</html>

<?php
$conn->close();
?>
