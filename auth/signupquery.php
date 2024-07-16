<?php
session_start();
include 'db_connection.php'; // Database connection

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
    $phone = $conn->real_escape_string($_POST['phone']);
    $created_at = date('Y-m-d H:i:s');

    // Debugging: Print values
    echo "Username: $username<br>";
    echo "Email: $email<br>";
    echo "Password (hashed): $password<br>";
    echo "Phone: $phone<br>";
    echo "Created at: $created_at<br>";

    // Check if username or email already exists
    $sql = "SELECT * FROM user WHERE username='$username' OR email='$email'";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        die("Database query failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $error_message = "Username or email already exists";
        header("Location: signup.php?error=" . urlencode($error_message));
        exit;
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO user (username, email, password, phone, created_at) VALUES ('$username', '$email', '$password', '$phone', '$created_at')";

        // Debugging: Print SQL query
        echo "SQL Query: $sql<br>";

        if ($conn->query($sql) === TRUE) {
            // Start session and set session variables
            $_SESSION['user_id'] = $conn->insert_id; // Get the last inserted ID
            $_SESSION['username'] = $username;
            header('Location: ../user/user_dashboard.php'); // Redirect to user dashboard
            exit;
        } else {
            $error_message = "Error: " . $conn->error;
            header("Location: signup.php?error=" . urlencode($error_message));
            exit;
        }
    }

    $conn->close();
}
