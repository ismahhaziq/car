<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];  // Assuming user_id is stored in session
    $car_id = $conn->real_escape_string($_POST['car_id']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);

    // Calculate total amount
    $sql = "SELECT price_per_day FROM cars WHERE id='$car_id'";
    $result = $conn->query($sql);
    $car = $result->fetch_assoc();
    $price_per_day = $car['price_per_day'];

    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = $start->diff($end);
    $days = $interval->days;
    $total_amount = $days * $price_per_day;

    // Insert booking
    $sql = "INSERT INTO bookings (user_id, car_id, start_date, end_date, total_amount) VALUES ('$user_id', '$car_id', '$start_date', '$end_date', '$total_amount')";
    if ($conn->query($sql) === TRUE) {
        $booking_id = $conn->insert_id;

        // Insert payment
        $sql = "INSERT INTO payments (booking_id, amount, payment_date) VALUES ('$booking_id', '$total_amount', CURDATE())";
        if ($conn->query($sql) === TRUE) {
            header('Location: booking_confirmation.php?booking_id=' . $booking_id);  // Redirect to booking confirmation
            exit;
        } else {
            $error_message = "Error processing payment: " . $conn->error;
        }
    } else {
        $error_message = "Error processing booking: " . $conn->error;
    }

    $conn->close();
}
?>
