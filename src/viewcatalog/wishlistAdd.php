<?php
// Start the session to access user details
session_start();

// Include the database connection
require '../dbconnections.php';

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo "<script>alert('You must be logged in to add items to your wishlist.'); window.location.href = '../login.php';</script>";
    exit;
}

// Get the current product id from the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid product ID.'); window.history.back();</script>";
    exit;
}

$product_id = intval($_GET['id']); // Sanitize the product ID
$user_id = intval($_SESSION['id']); // Get the logged-in user's ID

// Get product details from the catalog table
$sql_product = "SELECT id, title, image FROM catalog WHERE id = ?";
$stmt = $conn->prepare($sql_product);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Product not found.'); window.history.back();</script>";
    exit;
}

$product = $result->fetch_assoc(); // Fetch product details

// Insert the item into the wishlist table
$sql_insert = "INSERT INTO wishlist (image, title, productid, wishlistby) VALUES (?, ?, ?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("ssii", $product['image'], $product['title'], $product['id'], $user_id);

if ($stmt_insert->execute()) {
    echo "<script>alert('Item successfully added to your wishlist!'); window.location.href = '../profile section/wishlistProfile.php';</script>";
} else {
    echo "<script>alert('Failed to add item to wishlist. Please try again.'); window.history.back();</script>";
}

// Close the statements and database connection
$stmt->close();
$stmt_insert->close();
$conn->close();
?>
