<?php
session_start();
if (!isset($_SESSION['car_id'])) {
    header('Location: index.php'); // Redirect to home if no car is selected
    exit;
}
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
        .confirmation-container p {
            margin: 10px 0;
        }
        .btn {
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h2>Booking Confirmation</h2>
        <p>Car Model: <?php echo $_SESSION['car_model']; ?></p>
        <p>Price: $<?php echo $_SESSION['car_price']; ?>/day</p>
        <a href="confirm_booking.php" class="btn">Confirm Booking</a>
        <a href="index.php" class="btn">Cancel</a>
    </div>
</body>
</html>
