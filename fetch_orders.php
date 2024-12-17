<?php
include 'db_connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in";
    exit();
}

// Fetch customer name based on the user_id stored in the session
$user_id = $_SESSION['user_id'];
$sql_user = "SELECT name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql_user);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($customer_name);
$stmt->fetch();
$stmt->close();

// Query to fetch all orders including location
$sql_orders = "SELECT * FROM orders";
$result = $conn->query($sql_orders);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>" . ($row['customer_name'] ?: $customer_name) . "</td>"; // Use session fetched customer name if not found in order
        echo "<td>{$row['food_item']}</td>";
        echo "<td>{$row['quantity']}</td>";
        echo "<td>{$row['total_price']}</td>";
        echo "<td>{$row['order_date']}</td>";
        echo "<td>{$row['location']}</td>"; // Display the location
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No orders found</td></tr>"; // Adjusted colspan to include the location column
}

$conn->close();
?>
