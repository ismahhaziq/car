<?php
session_start();
include 'db_connect.php'; // Include your database connection file

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $conn->real_escape_string($_POST['car_id']);
    $user = $_SESSION['user'];
    $rental_date = $conn->real_escape_string($_POST['rental_date']);
    $return_date = $conn->real_escape_string($_POST['return_date']);

    // Insert rental record into the database
    $sql = "INSERT INTO rentals (car_id, username, rental_date, return_date) VALUES ('$car_id', '$user', '$rental_date', '$return_date')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Car rented successfully!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent a Car | Abe Nuar Car Rental</title>
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

        .rental-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .rental-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .rental-container input,
        .rental-container select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .rental-container button {
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .rental-container button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-bottom: 20px;
        }

        .success-message {
            color: green;
        }

        .error-message {
            color: red;
        }
    </style>
</head>

<body>
    <div class="rental-container">
        <h2>Rent a Car</h2>
        <?php if (isset($success_message)): ?>
            <p class="message success-message"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p class="message error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="rent_car.php" method="post">
            <select name="car_id" required>
                <option value="">Select a car</option>
                <?php
                // Fetch available cars from the database
                $car_sql = "SELECT * FROM cars WHERE available = 1";
                $car_result = $conn->query($car_sql);
                while ($car = $car_result->fetch_assoc()) {
                    echo "<option value='" . $car['id'] . "'>" . $car['make'] . " " . $car['model'] . "</option>";
                }
                ?>
            </select>
            <input type="date" name="rental_date" placeholder="Rental Date" required>
            <input type="date" name="return_date" placeholder="Return Date" required>
            <button type="submit">Rent Car</button>
        </form>
    </div>
</body>

</html>