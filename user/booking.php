<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

include 'db_connect.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST['car_id'];
    $user_id = $_SESSION['user_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $payment_method = $_POST['payment_method'];
    $amount = $_POST['amount'];

    // Insert booking into database
    $sql = "INSERT INTO bookings (user_id, car_id, start_date, end_date, payment_method, amount) 
            VALUES ('$user_id', '$car_id', '$start_date', '$end_date', '$payment_method', '$amount')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Booking successful!";
    } else {
        $error_message = "Error: " . $conn->error;
    }

    $conn->close();
}

// Fetch available cars
$cars = [];
$sql = "SELECT * FROM cars WHERE status='available'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Booking</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .booking-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px; text-align: center; }
        .booking-container h2 { margin-bottom: 20px; color: #333; }
        .booking-container input, .booking-container select { width: calc(100% - 20px); padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        .booking-container button { padding: 10px 20px; color: #fff; background-color: #007bff; border: none; border-radius: 4px; cursor: pointer; }
        .booking-container button:hover { background-color: #0056b3; }
        .success-message { color: green; margin-bottom: 20px; }
        .error-message { color: red; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="booking-container">
        <h2>Book a Car</h2>
        <?php if(isset($success_message)): ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <?php if(isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="booking.php" method="post">
            <select name="car_id" required>
                <option value="">Select a car</option>
                <?php foreach ($cars as $car): ?>
                    <option value="<?php echo $car['id']; ?>"><?php echo $car['model']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="date" name="start_date" placeholder="Start Date" required>
            <input type="date" name="end_date" placeholder="End Date" required>
            <select name="payment_method" required>
                <option value="">Select payment method</option>
                <option value="Credit Card">Credit Card</option>
                <option value="PayPal">PayPal</option>
            </select>
            <input type="number" name="amount" placeholder="Amount" required>
            <button type="submit">Book Now</button>
        </form>
    </div>
</body>
</html>
