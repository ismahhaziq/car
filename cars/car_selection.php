<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Selection | Abe Nuar Car Rental</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .car-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .car-card {
            background-color: #fff;
            padding: 20px;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 200px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .car-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
        .car-card h3 {
            margin: 10px 0;
        }
        .car-card p {
            margin: 5px 0;
        }
        .btn {
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
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
    <div class="car-container">
        <div class="car-card">
            <img src="images/car1.jpg" alt="Car 1">
            <h3>Car Model 1</h3>
            <p>Price: $50/day</p>
            <a href="reserve.php?car_id=1" class="btn">Reserve Now</a>
        </div>
        <div class="car-card">
            <img src="images/car2.jpg" alt="Car 2">
            <h3>Car Model 2</h3>
            <p>Price: $60/day</p>
            <a href="reserve.php?car_id=2" class="btn">Reserve Now</a>
        </div>
        <!-- Add more car cards as needed -->
    </div>
</body>
</html>
