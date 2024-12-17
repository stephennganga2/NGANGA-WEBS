<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['foodName'];
    $price = $_POST['foodPrice'];
    $category = $_POST['foodCategory'];

    $sql = "INSERT INTO foods (name, price, category) VALUES ('$name', '$price', '$category')";

    if ($conn->query($sql) === TRUE) {
        echo "New food item added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
