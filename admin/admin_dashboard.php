<?php
session_start();

// Check if the admin is logged in, if not then redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: admin_dashboard.php");
    exit;
}

// Include the database connection file
include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard|Abe Nuar Car Rental</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .nav {
            margin-bottom: 20px;
        }
        .nav a {
            display: inline-block;
            margin-right: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .nav a:hover {
            text-decoration: underline;
        }
        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .content {
            text-align: center;
        }
        .content h2 {
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
    </div>
    <div class="container">
        <div class="nav">
            <a href="manage_cars.php">Manage Cars</a>
            <a href="view_bookings.php">View Bookings</a>
            <a href="view_payments.php">View Payments</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="admin_logout.php" class="logout-btn">Logout</a>
        </div>
        <div class="content">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?>!</h2>
            <p>Use the navigation links above to manage the system.</p>
        </div>
    </div>
</body>
</html>
