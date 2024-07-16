<!-- In your car selection page (index.php) -->
<?php
include 'db_connection.php'; // Ensure you have the database connection file

$sql = "SELECT * FROM cars WHERE availability = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($car = $result->fetch_assoc()) {
        echo '
        <div class="car-card">
            <img src="images/' . $car['image'] . '" alt="Car">
            <h3>' . $car['model'] . '</h3>
            <p>Price: $' . $car['price_per_day'] . '/day</p>
            <a href="reserve.php?car_id=' . $car['id'] . '" class="btn">Reserve Now</a>
        </div>';
    }
} else {
    echo "No cars available for booking.";
}

$conn->close();
?>
