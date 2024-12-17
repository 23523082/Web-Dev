<?php 

require '../dbconnections.php';


ini_set('display_errors', 1);
error_reporting(E_ALL);
require '../dbconnections.php';

// Check if the product ID is passed in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Product ID not specified.");
}

$product_id = intval($_GET['id']); // Sanitize input

// Fetch product details from the database
$sql = "SELECT * FROM catalog WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the product exists
if ($result->num_rows === 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();
?>