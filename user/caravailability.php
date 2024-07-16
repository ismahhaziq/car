<?php
include 'db_connection.php';

// Fetch available cars
$sql = "SELECT * FROM cars WHERE is_available = 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Availability | Abe Nuar Car Rental</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .car-card {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .car-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .car-card h3 {
            margin: 10px 0;
        }
        .car-card p {
            margin: 5px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Available Cars</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="car-card">
                    <img src="<?php echo $row['image_url']; ?>" alt="Car Image">
                    <h3><?php echo $row['model']; ?></h3>
                    <p>Price: $<?php echo $row['price_per_day']; ?>/day</p>
                    <p>Available</p>
                    <a href="book_car.php?car_id=<?php echo $row['id']; ?>" class="btn">Book Now</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No cars available at the moment.</p>
        <?php endif; ?>
    </div>
    <?php $conn->close(); ?>
</body>
</html>
