<?php
session_start();
include 'db_connect.php'; // Ensure you have the database connection file

if (isset($_GET['car_id'])) {
    $car_id = intval($_GET['car_id']);

    // Fetch car details from the database
    $sql = "SELECT * FROM cars WHERE id = $car_id AND availability = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $car = $result->fetch_assoc();

        // Set session variables
        $_SESSION['car_id'] = $car['id'];
        $_SESSION['car_model'] = $car['model'];
        $_SESSION['car_price'] = $car['price_per_day'];

        // Redirect to a booking confirmation or reservation page
        header('Location: booking_confirmation.php');
    } else {
        echo "Car is not available for booking.";
    }
} else {
    echo "Invalid car selection.";
}

$conn->close();
?>
