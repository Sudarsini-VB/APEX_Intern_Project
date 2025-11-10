<?php
// Set header for JSON output
header('Content-Type: application/json');

// Dummy user data (simulate database results)
$existingUsers = ["john", "alice", "bob"];
$existingEmails = ["john@example.com", "alice@example.com", "bob@example.com"];

// Get and sanitize user inputs
$username = isset($_GET['username']) ? strtolower(trim($_GET['username'])) : '';
$email = isset($_GET['email']) ? strtolower(trim($_GET['email'])) : '';

$response = [
    'status' => 'available',  // default response
    'message' => 'Username and email are available.'
];

// Check username
if (!empty($username) && in_array($username, $existingUsers)) {
    $response = [
        'status' => 'username_exists',
        'message' => 'This username is already taken.'
    ];
}

// Check email
if (!empty($email) && in_array($email, $existingEmails)) {
    $response = [
        'status' => 'email_exists',
        'message' => 'This email is already registered.'
    ];
}

// Send JSON response
echo json_encode($response);
?>
