<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px; text-align: center; }
        .login-container h2 { margin-bottom: 20px; color: #333; }
        .login-container input { width: calc(100% - 20px); padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        .login-container button { padding: 10px 20px; color: #fff; background-color: #007bff; border: none; border-radius: 4px; cursor: pointer; }
        .login-container button:hover { background-color: #0056b3; }
        .error-message { color: red; margin-bottom: 20px; }
        .signup-button { margin-top: 10px; background-color: #28a745; }
        .signup-button:hover { background-color: #218838; }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const errorMessage = document.querySelector('.error-message');
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.display = 'none';
                }, 3000); // 3 seconds
            }
        });
    </script>
</head>
<body>
    <div class="login-container">
        <h2>User Login</h2>
        <?php if (isset($_GET['error'])): ?>
                <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
                <p class="success-message"><?php echo htmlspecialchars($_GET['success']); ?></p>
        <?php endif; ?>
        <form action="loginquery.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <button class="signup-button" onclick="window.location.href='signup.php'">Sign Up</button>
    </div>
</body>
</html>
