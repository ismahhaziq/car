<?php
session_start();
include 'db_connect.php'; // Ensure you have the database connection file

if (!isset($_SESSION['car_id']) || !isset($_SESSION['user'])) {
    header('Location: index.php'); // Redirect to home if no car is selected or user is not logged in
    exit;
}

$car_id = $_SESSION['car_id'];
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session after login
$start_date = '2024-07-10'; // You need to get this date from user input in a real scenario
$end_date = '2024-07-15'; // You need to get this date from user input in a real scenario

// Calculate total price (assuming the price is per day)
$price_per_day = $_SESSION['car_price'];
$total_days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
$total_price = $total_days * $price_per_day;

// Insert booking into the database
$sql = "INSERT INTO bookings (user_id, car_id, start_date, end_date, total_price, status) VALUES ($user_id, $car_id, '$start_date', '$end_date', $total_price, 'Confirmed')";

if ($conn->query($sql) === TRUE) {
    // Update car availability
    $sql_update = "UPDATE cars SET availability = 0 WHERE id = $car_id";
    $conn->query($sql_update);

    echo "Booking confirmed!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
