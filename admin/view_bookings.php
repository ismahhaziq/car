<?php
session_start();

// Check if the admin is logged in, if not then redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// Include the database connection file
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings | Abe Nuar Car Rental</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>View Bookings</h1>
    </div>
    <div class="container">
        <div class="nav">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="manage_cars.php">Manage Cars</a>
            <a href="view_bookings.php">View Bookings</a>
            <a href="view_payments.php">View Payments</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="admin_logout.php" class="logout-btn">Logout</a>
        </div>
        <div class="content">
            <h2>Bookings List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Car ID</th>
                        <th>User ID</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch bookings from the database
                    $sql = "SELECT * FROM bookings";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['booking_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['car_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['start_date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['end_date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No bookings found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
