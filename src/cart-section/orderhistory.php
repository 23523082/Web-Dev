<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['id']) || !isset($_SESSION['type'])) {
    header("Location: ../account-section/login.php");
    exit;
}

if (isset($_SESSION['order_success'])) {
    echo '<div class="alert success">' . $_SESSION['order_success'] . '</div>';
    unset($_SESSION['order_success']); // Clear the success message after showing it
} elseif (isset($_SESSION['order_error'])) {
    echo '<div class="alert error">' . $_SESSION['order_error'] . '</div>';
    unset($_SESSION['order_error']); // Clear the error message after showing it
}

require '../dbconnections.php';

$userId = $_SESSION['id'];

// Fetch order details and seller info for the logged-in user
$query = "SELECT o.*, c.sellerid FROM orders o LEFT JOIN catalog c ON o.title = c.title WHERE o.orderby = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Initialize arrays for the titles, prices, and sellers
$titles = [];
$prices = [];
$sellers = [];

foreach ($orders as $order) {
    $titles[] = $order['title'];
    $prices[] = $order['price'];
    $sellers[] = $order['sellerid'];  // Ensure seller is fetched and assigned
}

try {
    // Loop through the order items and insert them into orderhistory
    foreach ($titles as $index => $title) {
        $price = $prices[$index];
        $sellerId = $sellers[$index];

        // Check if sellerId is null or not
        if ($sellerId === null) {
            throw new Exception("Seller ID is missing for the item: $title");
        }

        // Insert into orderhistory table
        $query = "INSERT INTO orderhistory (title, price, selledby, buyby) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssii", $title, $price, $sellerId, $userId);
        $stmt->execute();

        // Delete from orders table
        $deleteQuery = "DELETE FROM orders WHERE orderby = ? AND title = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("is", $userId, $title);
        $deleteStmt->execute();
    }

    // Set session variable to indicate success
    $_SESSION['order_success'] = 'Order processed successfully!';

} catch (Exception $e) {
    // Set session variable to indicate error
    $_SESSION['order_error'] = $e->getMessage();
}

// Redirect back to the same page to display the success/error message
header("Location: ../profiles section/orderHistory.php");
exit;

