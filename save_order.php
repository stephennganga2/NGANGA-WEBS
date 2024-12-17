
<?php   
session_start();
include 'db_connect.php'; // Ensure this file contains your database connection

// Fetch available foods from the database
$sql_foods = "SELECT * FROM foods";
$result_foods = $conn->query($sql_foods);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff3e0;
            color: #4a2c2a;
        }

        header {
            background-color: #d84315;
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

        h1, h2 {
            color: #d84315;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        table th, table td {
            border: 1px solid #d84315;
            padding: 0.75rem;
            text-align: left;
        }

        table th {
            background-color: #4a2c2a;
            color: white;
        }

        button {
            background-color: #d84315;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #bf360c;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4a2c2a;
        }

        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d84315;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Food Order System!</h1>
    </header>
    <div class="container">
        <!-- Display available foods -->
        <h2>Available Foods</h2>
        <table>
            <thead>
                <tr>
                    <th>Food ID</th>
                    <th>Food Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_foods->num_rows > 0): ?>
                    <?php while ($food = $result_foods->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $food['id']; ?></td>
                            <td><?php echo $food['name']; ?></td>
                            <td><?php echo "$" . number_format($food['price'], 2); ?></td>
                            <td><?php echo $food['category']; ?></td>
                            <td>
                                <button onclick="addToCart('<?php echo $food['id']; ?>', '<?php echo $food['name']; ?>', <?php echo $food['price']; ?>)">
                                    Add to Cart
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No foods available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Cart Section -->
        <h2>My Cart</h2>
        <form action="save_order.php" method="POST" id="orderForm">
            <table>
                <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cartTable">
                    <tr>
                        <td colspan="5">Your cart is empty.</td>
                    </tr>
                </tbody>
            </table>

            <!-- Customer's Name input (added manually) -->
            <div class="form-group">
                <label for="customerName">Customer Name:</label>
                <input type="text" id="customerName" name="customer_name" required>
            </div>

            <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="location">Delivery Location:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <input type="hidden" name="cart" id="cartData">
            <button type="submit">Confirm Order</button>
        </form>
    </div>

    <script>
        let cart = [];

        function addToCart(id, name, price) {
            const existingItem = cart.find(item => item.foodItem === name);
            if (existingItem) {
                existingItem.quantity += 1;
                existingItem.totalPrice = existingItem.quantity * price;
            } else {
                cart.push({ foodItem: name, quantity: 1, price: price, totalPrice: price });
            }
            renderCart();
        }

        function removeFromCart(name) {
            cart = cart.filter(item => item.foodItem !== name);
            renderCart();
        }

        function renderCart() {
            const cartTable = document.getElementById("cartTable");
            cartTable.innerHTML = "";

            if (cart.length === 0) {
                cartTable.innerHTML = "<tr><td colspan='5'>Your cart is empty.</td></tr>";
                return;
            }

            cart.forEach(item => {
                const row = `<tr>
                    <td>${item.foodItem}</td>
                    <td>${item.quantity}</td>
                    <td>$${item.price.toFixed(2)}</td>
                    <td>$${item.totalPrice.toFixed(2)}</td>
                    <td>
                        <button onclick="removeFromCart('${item.foodItem}')">Remove</button>
                    </td>
                </tr>`;
                cartTable.innerHTML += row;
            });

            document.getElementById("cartData").value = JSON.stringify(cart);
        }
    </script>
</body>
</html>

<?php
// Include database connection
include 'db_connect.php';

// Retrieve cart data and customer details from the form
$cartData = isset($_POST['cart']) ? json_decode($_POST['cart'], true) : [];
$customerName = isset($_POST['customer_name']) ? $_POST['customer_name'] : ''; // Get customer name
$phoneNumber = isset($_POST['phone_number']) ? $_POST['phone_number'] : ''; // Get phone number
$location = isset($_POST['location']) ? $_POST['location'] : ''; // Get location
$orderDate = date('Y-m-d H:i:s'); // Get current date and time

// Process the cart data and insert it into the orders table
if (!empty($cartData)) {
    foreach ($cartData as $item) {
        // Set a default user_id (You can modify this as per your need, e.g., retrieve from session)
        $userId = 1; // Example: default user_id (can be dynamic based on session if needed)

        // Insert each item into the orders table
        $stmt = $conn->prepare("INSERT INTO orders (user_id, food_item, quantity, total_price, customer_name, phone_number, location, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isdsisss", $userId, $item['foodItem'], $item['quantity'], $item['totalPrice'], $customerName, $phoneNumber, $location, $orderDate);
        $stmt->execute();
    }
    echo "Order placed successfully.";
} else {
    echo "Cart is empty.";
}

$conn->close(); // Close the database connection
?>
