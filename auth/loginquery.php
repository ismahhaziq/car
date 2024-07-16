<?php
session_start();
include '../db_connection.php'; // Database connection

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Check if user exists in the database
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        die("Database query failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $username;
            header('Location: ../user/user_dashboard.php'); // Redirect to user dashboard
            exit;
        } else {
            $error_message = "Invalid username or password";
            header("Location: login.php?error=" . urlencode($error_message));
            exit;
        }
    } else {
        $error_message = "Invalid username or password";
        header("Location: login.php?error=" . urlencode($error_message));
        exit;
    }
}

