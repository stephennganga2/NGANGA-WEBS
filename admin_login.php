<?php
session_start();
include 'db_connect.php'; // Ensure this file contains your database connection

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the query to fetch admin details from the database
    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // Bind the username parameter to prevent SQL injection
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record is found
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        
        // Verify the hashed password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];  // Store admin ID in session
            header("Location: adminn.php"); // Redirect to admin dashboard
            exit();
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "Invalid username!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Mamanima Foods</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #8b4513; /* Dark brown */
        }
        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .login-btn {
            width: 100%;
            padding: 10px;
            background-color: #8b4513; /* Dark brown */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .login-btn:hover {
            background-color: #d16d1f; /* Orange */
        }
        .error-message {
            color: red;
            text-align: center;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Admin Login</h2>

    <!-- Display error message if credentials are wrong -->
    <?php if (isset($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" action="admin_login.php">
        <input type="text" class="input-field" name="username" placeholder="Username" required>
        <input type="password" class="input-field" name="password" placeholder="Password" required>
        <button type="submit" class="login-btn">Log In</button>
    </form>
</div>

<div class="footer">
    <p>&copy; 2024 Mamanima Foods | All Rights Reserved</p>
</div>

</body>
</html>
