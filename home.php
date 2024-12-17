<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mamanima Foods</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff3e0; /* Light orange background */
            color: #4a2c2a; /* Dark brown text */
        }

        header {
            background-color: #d84315; /* Orange */
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 5rem auto;
            padding: 2rem;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            color: #d84315; /* Orange */
            text-align: center;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4a2c2a; /* Dark brown */
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d84315; /* Orange */
            border-radius: 4px;
        }

        button {
            background-color: #d84315; /* Orange */
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #bf360c; /* Darker orange */
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>Login - Mamanima Foods</h1>
    </header>

    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="footer">
    <p>Don't have an account? <a href="signup.html">signup</a></p>
</div>
        <!-- Display error message if login fails -->
        <div class="error">
            <?php
                if (isset($_GET['error'])) {
                    echo "Invalid email or password. Please try again.";
                }
            ?>
        </div>
    </div>
</body>
</html>
