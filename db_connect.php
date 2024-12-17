<?php
// db_connect.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodsdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// To be included in other files
?>
