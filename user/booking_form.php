<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Booking | Abe Nuar Car Rental</title>
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
        .booking-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .booking-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .booking-container input, .booking-container select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .booking-container button {
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .booking-container button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="booking-container">
        <h2>Car Booking</h2>
        <?php if(isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="process_booking.php" method="post">
            <label for="car">Select Car:</label>
            <select name="car_id" id="car" required>
                <?php
                include 'db_connection.php';
                $sql = "SELECT * FROM cars";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['id']."'>".$row['model']." - $".$row['price_per_day']."/day</option>";
                }
                ?>
            </select>
            <input type="date" name="start_date" required>
            <input type="date" name="end_date" required>
            <button type="submit">Book Now</button>
        </form>
    </div>
</body>
</html>
