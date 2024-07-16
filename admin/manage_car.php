<?php
session_start();

// Check if the admin is logged in, if not then redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// Include the database connection file
include 'db_connect.php';

// Handle form submission for adding a new car
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_car'])) {
    $car_name = $conn->real_escape_string($_POST['car_name']);
    $car_model = $conn->real_escape_string($_POST['car_model']);
    $car_price = $conn->real_escape_string($_POST['car_price']);
    $car_image = $conn->real_escape_string($_POST['car_image']);

    $sql = "INSERT INTO cars (name, model, price, image) VALUES ('$car_name', '$car_model', '$car_price', '$car_image')";

    if ($conn->query($sql) === TRUE) {
        $message = "Car added successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle car deletion
if (isset($_GET['delete'])) {
    $car_id = $conn->real_escape_string($_GET['delete']);

    $sql = "DELETE FROM cars WHERE id = '$car_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Car deleted successfully.";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch the list of cars from the database
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars | Abe Nuar Car Rental</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .nav {
            margin-bottom: 20px;
        }
        .nav a {
            display: inline-block;
            margin-right: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .nav a:hover {
            text-decoration: underline;
        }
        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .content {
            text-align: center;
        }
        .content h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        .form-group input {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group button {
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .action-btn {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #28a745;
        }
        .delete-btn {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Manage Cars</h1>
    </div>
    <div class="container">
        <div class="nav">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="manage_cars.php">Manage Cars</a>
            <a href="view_bookings.php">View Bookings</a>
            <a href="view_payments.php">View Payments</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="admin_logout.php" class="logout-btn">Logout</a>
        </div>
        <div class="content">
            <h2>Add New Car</h2>
            <?php if (isset($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
            <form action="manage_cars.php" method="post">
                <div class="form-group">
                    <label for="car_name">Car Name:</label>
                    <input type="text" id="car_name" name="car_name" required>
                </div>
                <div class="form-group">
                    <label for="car_model">Car Model:</label>
                    <input type="text" id="car_model" name="car_model" required>
                </div>
                <div class="form-group">
                    <label for="car_price">Car Price:</label>
                    <input type="text" id="car_price" name="car_price" required>
                </div>
                <div class="form-group">
                    <label for="car_image">Car Image URL:</label>
                    <input type="text" id="car_image" name="car_image" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="add_car">Add Car</button>
                </div>
            </form>
            <h2>Car Listings</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['model']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="100"></td>
                            <td>
                                <a href="edit_car.php?id=<?php echo $row['id']; ?>" class="action-btn edit-btn">Edit</a>
                                <a href="manage_cars.php?delete=<?php echo $row['id']; ?>" class="action-btn delete-btn">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No cars found.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
