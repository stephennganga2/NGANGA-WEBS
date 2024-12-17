<?php
session_start();
include 'db_connect.php'; // Ensure this file contains your database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginn.php"); // Redirect to login if not logged in
    exit();
}

// Retrieve user data from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_name);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Mamanima Foods</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3e0c1; /* Light brown background */
        }
        header {
            background-color: #8b4513; /* Dark brown header */
            color: white;
            text-align: center;
            padding: 20px 0;
        }
        .container {
            padding: 20px;
        }
        .welcome-message {
            text-align: center;
            margin-bottom: 20px;
            color: #8b4513;
        }
        .content {
            margin-top: 30px;
        }
        .advert-section {
            background-color: #f7f0e2; /* Light beige for adverts */
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .advert-section h3 {
            color: #d16d1f; /* Orange header for adverts */
        }
        .contact-info, .offers {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .contact-info h3, .offers h3 {
            color: #8b4513; /* Dark brown for section headings */
        }
        .offers ul {
            list-style-type: none;
            padding-left: 0;
        }
        .offers li {
            margin-bottom: 10px;
            font-size: 16px;
            color: #d16d1f; /* Orange color for offers */
        }
        .offer-price {
            color: red;
        }
        footer {
            background-color: #8b4513;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Contact Us | Mamanima Foods</h1>
</header>

<div class="container">
    <div class="welcome-message">
        <h2>Hello, <?php echo htmlspecialchars($user_name); ?>!</h2>
        <p>Welcome to our contact page. We're here to serve you better. Get in touch and check out our new food items and Christmas offers!</p>
    </div>

    <div class="content">
        <div class="contact-info">
            <h3>Contact Information</h3>
            <p>If you have any questions or need assistance, feel free to contact us:</p>
            <p><strong>Email:</strong> support@mamanimafoods.com</p>
            <p><strong>Phone:</strong> +123 456 7890</p>
            <p><strong>Address:</strong> 123 Food Street, Nairobi, Kenya</p>
        </div>

        <div class="advert-section">
            <h3>New Food Items</h3>
            <p>We have introduced some exciting new food items that you must try!</p>
            <ul>
                <li><strong>BBQ Ribs</strong> - Succulent ribs grilled to perfection. Only $15.99</li>
                <li><strong>Vegetarian Burger</strong> - A delicious plant-based burger. Only $9.99</li>
                <li><strong>Truffle Fries</strong> - Crispy fries with a rich truffle flavor. Only $7.99</li>
            </ul>
        </div>

        <div class="advert-section">
            <h3>Christmas Offers</h3>
            <p>Celebrate this Christmas with our exclusive holiday deals:</p>
            <ul>
                <li><strong>Christmas Feast Platter</strong> - A special platter with all your favorite holiday dishes. Only <span class="offer-price">$29.99</span> (Save $10!)</li>
                <li><strong>Family Pizza Deal</strong> - Buy 2 large pizzas and get 1 free! Only <span class="offer-price">$24.99</span></li>
                <li><strong>Free Drink with Every Meal</strong> - Enjoy a complimentary drink with every meal ordered during the Christmas season!</li>
            </ul>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 Mamanima Foods | All Rights Reserved</p>
</footer>

</body>
</html>
