<?php
require('connection.php');

if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pwd = $_POST['pwd'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];

    $query1 = "INSERT INTO registration (fname, lname, email, phone, pwd, dob, gender, country) VALUES ('$fname', '$lname', '$email', '$phone', '$pwd', '$dob', '$gender', '$country')";
    $query2 = mysqli_query($conn, $query1);

    if ($query2) {
        header("Location: users.html");
        exit();
    } else {
        echo "<h1 style='color: blue'>Your upload was not successful, contact the developer</h1>";
    }
}
?>
