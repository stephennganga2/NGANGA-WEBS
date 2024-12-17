<?php
// Include database connection
include 'db_connect.php';

// Fetch orders from the database
$sql_orders = "SELECT * FROM orders";
$result_orders = $conn->query($sql_orders);

// Fetch foods from the database
$sql_foods = "SELECT * FROM foods";
$result_foods = $conn->query($sql_foods);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Mamanima Foods</title>
    <style>
        /* CSS styles remain unchanged */
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
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            color: #d84315; /* Orange */
        }

        .section {
            margin-bottom: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        table th, table td {
            border: 1px solid #d84315; /* Orange */
            padding: 0.75rem;
            text-align: left;
        }

        table th {
            background-color: #4a2c2a; /* Dark brown */
            color: white;
        }

        button {
            background-color: #d84315; /* Orange */
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #bf360c; /* Darker orange */
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
            padding: 0.5rem;
            border: 1px solid #d84315; /* Orange */
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard - Mamanima Foods</h1>
    </header>
    <div class="container">
        <!-- Orders Section -->
        <div class="section">
            <h2>Customer Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Food Item</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                        <th>Location</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_orders->num_rows > 0) {
                        while ($row = $result_orders->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['order_id']}</td>
                                    <td>{$row['customer_name']}</td>
                                    <td>{$row['food_item']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>$" . number_format($row['total_price'], 2) . "</td>
                                    <td>{$row['order_date']}</td>
                                    <td>{$row['location']}</td>
                                    <td>{$row['phone_number']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No orders yet.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Foods Section -->
        <div class="section">
            <h2>Available Foods</h2>
            <table>
                <thead>
                    <tr>
                        <th>Food ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_foods->num_rows > 0) {
                        while ($row = $result_foods->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>$" . number_format($row['price'], 2) . "</td>
                                    <td>{$row['category']}</td>
                                    
                                    <td>
                                        <form action='delete_food.php' method='POST' style='display:inline;'>
                                            <input type='hidden' name='food_id' value='{$row['id']}'>
                                            <button type='submit'>Delete</button>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No foods available.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Add Food Section -->
        <div class="section">
            <h2>Add New Food</h2>
            <form action="add_food.php" method="POST">
                <div class="form-group">
                    <label for="foodName">Food Name:</label>
                    <input type="text" id="foodName" name="foodName" required>
                </div>
                <div class="form-group">
                    <label for="foodPrice">Price:</label>
                    <input type="number" id="foodPrice" name="foodPrice" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="foodCategory">Category:</label>
                    <input type="text" id="foodCategory" name="foodCategory" required>
                </div>
                
                <button type="submit">Add Food</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>
