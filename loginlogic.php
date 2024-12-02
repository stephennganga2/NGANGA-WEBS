<?php
require('connection.php'); 

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $query = "SELECT * FROM registration WHERE email='$email' AND pwd='$pwd'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        session_start();
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id']; 
        $_SESSION['user_name'] = $user['fname'] . " " . $user['lname'];
        header("Location: dashboard.html"); // Redirect to dashboard
        exit();
    } else {
        echo "<h3 style='color: red; text-align: center;'>Invalid email or password. Please try again.</h3>";
    }
}
?>
