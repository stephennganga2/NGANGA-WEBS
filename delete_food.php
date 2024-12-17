<?php
// Include database connection
include 'db_connect.php';

// Check if food ID is received
if (isset($_POST['food_id'])) {
    $food_id = $_POST['food_id'];

    // Prepare and execute deletion query
    $stmt = $conn->prepare("DELETE FROM foods WHERE id = ?");
    $stmt->bind_param("i", $food_id);

    if ($stmt->execute()) {
        echo "Food item deleted successfully.";
    } else {
        echo "Error deleting food item: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No food ID provided.";
}

$conn->close();

// Redirect back to admin dashboard
header("Location: admin_dashboard.php");
exit();
?>
