<?php
session_start();
include 'db_connect.php';

if (!isset($_GET['booking_id'])) {
    header('Location: user_dashboard.php');  // Redirect if booking_id is not set
    exit;
}

$booking_id = $_GET['booking_id'];

$sql = "SELECT b.id, c.model, b.start_date, b.end_date, b.total_amount 
        FROM bookings b
        JOIN cars c ON b.car_id = c.id
        WHERE b.id = '$booking_id'";
$result = $conn->query($sql);
$booking = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation | Abe Nuar Car Rental</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .confirmation-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .confirmation-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h2>Booking Confirmation</h2>
        <p>Car: <?php echo $booking['model']; ?></p>
        <p>Start Date: <?php echo $booking['start_date']; ?></p>
        <p>End Date: <?php echo $booking['end_date']; ?></p>
        <p>Total Amount: $<?php echo $booking['total_amount']; ?></p>
        <p>Thank you for your booking!</p>
    </div>
</body>
</html>
