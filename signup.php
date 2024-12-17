<?php
// Include database connection
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $location = $_POST['location']; // New field for location

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert user details into the database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, contact, location) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $hashedPassword, $contact, $location);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to login page after successful signup
        header("Location: loginn.php"); // Redirect to the login page
        exit(); // Make sure no further code is executed after the redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>

