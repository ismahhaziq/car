<?php
session_start();

// Check if the admin is logged in, if not then redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// Include the database connection file
include 'db_connect.php';

// Fetch payment records from the database
$sql = "SELECT id, customer_name, car_id, amount, payment_date FROM payments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments | Abe Nuar Car Rental</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
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
            <h2>Payments</h2>
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Car ID</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                    </tr>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['car_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['amount']); ?></td>
                            <td><?php echo htmlspecialchars($row['payment_date']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No payment records found.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php $conn->close(); // Close the connection ?>
	

</body>
</html>
