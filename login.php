<?php
// Start the session to track the user's login status
session_start();

// Include the database connection
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL query to fetch the user based on the email
    $stmt = $conn->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        // Bind the result to variables
        $stmt->bind_result($userId, $userName, $userEmail, $hashedPassword);

        // Fetch the result
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Correct password, start a session
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_name'] = $userName;
            $_SESSION['user_email'] = $userEmail;

            // Redirect to the user dashboard or home page
            header("Location: homee.php"); // Change to the desired page
            exit();
        } else {
            // Incorrect password
            header("Location: home.php?error=1");
            exit();
        }
    } else {
        // No user found with the provided email
        header("Location: home.php?error=1");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
