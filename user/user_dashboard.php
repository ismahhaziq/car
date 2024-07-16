<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .dashboard-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px; text-align: center; }
        .dashboard-container h2 { margin-bottom: 20px; color: #333; }
        .dashboard-container a { padding: 10px 20px; color: #fff; background-color: #007bff; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .dashboard-container a:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
        <a href="../auth/logout.php">Logout</a>
    </div>
</body>
</html>
