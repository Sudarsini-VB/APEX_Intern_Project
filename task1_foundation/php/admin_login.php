<?php
session_start();

// If already logged in, go to view page
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: view_messages.php");
    exit;
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];

    // Set your admin password here
    $admin_password = "admin123"; // Change this to your secret password

    if ($password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: view_messages.php");
        exit;
    } else {
        $error = "Incorrect password. Try again!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login | Sudarsini Portfolio</title>
<style>
  body {
    font-family: "Poppins", sans-serif;
    background: linear-gradient(135deg, #1e293b, #0f172a);
    color: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }
  .login-box {
    background: rgba(255, 255, 255, 0.05);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.4);
    text-align: center;
    width: 300px;
  }
  h2 {
    color: #38bdf8;
    margin-bottom: 20px;
  }
  input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #38bdf8;
    border-radius: 6px;
    background: #0f172a;
    color: #f8fafc;
    margin-bottom: 15px;
  }
  button {
    background: #38bdf8;
    color: #0f172a;
    font-weight: 600;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
  }
  button:hover {
    background: #facc15;
  }
  .error {
    color: #ef4444;
    margin-bottom: 10px;
  }
</style>
</head>
<body>
  <div class="login-box">
    <h2>🔐 Admin Login</h2>
    <?php if (!empty($error)): ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
      <input type="password" name="password" placeholder="Enter admin password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
