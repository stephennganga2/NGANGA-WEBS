
<?php
include 'db_connect.php'; // Ensure this file contains your database connection

// Food names and prices (randomized for example)
$food_items = [
    ['name' => 'Burger', 'price' => rand(5, 15)],
    ['name' => 'Pizza', 'price' => rand(8, 20)],
    ['name' => 'Pasta', 'price' => rand(7, 18)],
    ['name' => 'Sushi', 'price' => rand(10, 25)],
    ['name' => 'Salad', 'price' => rand(4, 12)],
    ['name' => 'Tacos', 'price' => rand(6, 15)],
    ['name' => 'Steak', 'price' => rand(12, 30)],
    ['name' => 'Soup', 'price' => rand(4, 10)],
    ['name' => 'Sandwich', 'price' => rand(5, 12)],
    ['name' => 'Ice Cream', 'price' => rand(3, 8)],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Mamanima Foods</title>
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
            color: #8b4513; /* Dark brown text */
        }
        .food-gallery {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }
        .food-gallery img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        .food-gallery img:hover {
            transform: scale(1.05);
        }
        .food-item {
            text-align: center;
            margin-top: 5px;
            font-size: 14px;
            color: #8b4513;
        }

        /* Sidebar styles */
        .side-popup {
            height: 100%;
            width: 0;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #d16d1f; /* Orange background for sidebar */
            overflow-x: hidden;
            transition: 0.3s;
            padding-top: 60px;
        }

        .side-popup a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .side-popup a:hover {
            color: #fff;
            background-color: #ff5722; /* Red on hover */
        }

        .side-popup .close-btn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .open-btn {
            font-size: 30px;
            cursor: pointer;
            color: #8b4513; /* Dark brown button */
            background-color: #fff;
            padding: 10px 20px;
            border: 2px solid #8b4513; /* Brown border */
            border-radius: 5px;
        }

        .open-btn:hover {
            background-color: #ff5722; /* Red background on hover */
            color: white;
        }

        .order-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #ff5722; /* Red button */
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .order-button:hover {
            background-color: #e64a19; /* Darker red on hover */
        }

    </style>
</head>
<body>

<header>
    <h1>Welcome to Mamanima Foods</h1>
</header>
 <!-- Button to open the sidebar -->
 <button class="open-btn" onclick="openNav()">Menu</button>

<!-- Side Popup / Sidebar -->
<div id="mySidebar" class="side-popup">
    <a href="javascript:void(0)" class="close-btn" onclick="closeNav()">×</a>
    <a href="save_order.php">Place an Order</a>
    <a href="contact.php">Contact Us</a>
    <a href="adminn.php">Admin Panel</a>
</div>

<div class="container">
    <div class="welcome-message">
        <h2>Welcome to Mamanima Foods!</h2>
        <p>Check out our delicious food options below:</p>
    </div>

    <div class="food-gallery">
        <?php foreach ($food_items as $index => $item): ?>
            <div class="food-item">
                <img src="<?php echo ($index + 1); ?>.jpg" alt="Food <?php echo ($index + 1); ?>">
                <div><?php echo $item['name']; ?></div>
                <div>$<?php echo number_format($item['price'], 2); ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Order button to redirect -->
    <a href="save_order.php" class="order-button">Place an Order</a>

</div>

<script>
    // Function to open the side popup (sidebar)
    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
    }

    // Function to close the side popup (sidebar)
    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
    }
</script>

</body>
</html>
