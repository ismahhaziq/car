<?php
session_start();

// Check if the admin is logged in, if not then redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// Include the database connection file
include 'db_connect.php';

// Handle user addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        $message = "User added successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle user update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_user'])) {
    $user_id = $conn->real_escape_string($_POST['user_id']);
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "UPDATE users SET username='$username', email='$email' WHERE id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        $message = "User updated successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle user deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $user_id = $conn->real_escape_string($_POST['user_id']);

    $sql = "DELETE FROM users WHERE id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        $message = "User deleted successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | Abe Nuar Car Rental</title>
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
        .message {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-container {
            margin-top: 20px;
        }
        .form-container input, .form-container button {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            box-sizing: border-box;
        }
        .form-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Manage Users</h1>
    </div>
    <div class="container">
        <?php if (isset($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <h2>User List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <form action="manage_users.php" method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                            <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
                            <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
                            <button type="submit" name="update_user">Update</button>
                        </form>
                        <form action="manage_users.php" method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_user">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <div class="form-container">
            <h2>Add New User</h2>
            <form action="manage_users.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="add_user">Add User</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
