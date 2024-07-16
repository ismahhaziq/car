<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST['car_id'];
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $booking_date = $_POST['booking_date'];
    $return_date = $_POST['return_date'];

    // Insert booking into the database
    $sql = "INSERT INTO bookings (car_id, customer_name, booking_date, return_date) VALUES ('$car_id', '$customer_name', '$booking_date', '$return_date')";

    if ($conn->query($sql) === TRUE) {
        // Update car availability
        $sql_update = "UPDATE cars SET is_available = 0 WHERE id = '$car_id'";
        $conn->query($sql_update);
        echo "Booking successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    $car_id = $_GET['car_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Car | Abe Nuar Car Rental</title>
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
        .booking-container input {
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
    </style>
</head>
<body>
    <div class="booking-container">
        <h2>Book Car</h2>
        <form action="book_car.php" method="post">
            <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
            <input type="text" name="customer_name" placeholder="Your Name" required>
            <input type="date" name="booking_date" required>
            <input type="date" name="return_date" required>
            <button type="submit">Book Now</button>
        </form>
    </div>
</body>
</html>
