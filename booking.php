<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .search-section, .available-cars, .reservation-section {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .car-card {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
			text-align: center;
        }
        .car-card img {
           display: block;
		   margin: 0 auto 16px;
		   max-width: 40%;
           height: auto;
        }
        .car-card h3 {
            margin-top: 0;
        }
        .car-card p {
            margin-bottom: 5px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to Abe Nuar's Car Rental</h1>
    </div>
    <div class="container">
        <!-- Search Section -->
        <div class="search-section">
            <h2>Search for Cars</h2>
            <form>
                <label for="pickup-location">Pickup Location:</label>
                <input type="text" id="pickup-location" name="pickup-location"><br><br>
                <label for="pickup-date">Pickup Date:</label>
                <input type="date" id="pickup-date" name="pickup-date"><br><br>
                <label for="return-date">Return Date:</label>
                <input type="date" id="return-date" name="return-date"><br><br>
                <button type="submit" class="btn">Search</button>
            </form>
        </div>
        
        <!-- Reservation Section -->
        <div class="reservation-section">
            <h2>Make a Reservation</h2>
            <form>
                <label for="full-name">Full Name:</label>
                <input type="text" id="full-name" name="full-name"><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"><br><br>
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone"><br><br>
                <label for="car-model">Car Model:</label>
                <input type="text" id="car-model" name="car-model"><br><br>
                <label for="pickup-date-reservation">Pickup Date:</label>
                <input type="date" id="pickup-date-reservation" name="pickup-date-reservation"><br><br>
                <label for="return-date-reservation">Return Date:</label>
                <input type="date" id="return-date-reservation" name="return-date-reservation"><br><br>
                <button type="submit" class="btn">Submit Booking</button>
            </form>
        </div>
		        <!-- Available Cars Section -->
        <div class="available-cars">
            <h2>Available Cars</h2>
            <div class="car-card">
                <img src="images/1.png" alt="Car Image">
                <h3>Car Model</h3>
                <p>Price: $50/day</p>
                <p>Description of the car.</p>
                <a href="#" class="btn">Booking Now</a>
            </div>
            <!-- Repeat .car-card divs for more cars -->
        </div>
        
    </div>
</body>
</html>

    