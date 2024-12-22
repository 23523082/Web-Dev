<?php 

require '../dbconnections.php';

// Display errors for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the product ID is passed in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Product ID not specified.");
}

$product_id = intval($_GET['id']); // Sanitize input

// Fetch product and seller details using a JOIN query
$sql = "
    SELECT 
        catalog.*, 
        users.FirstName, 
        users.LastName 
    FROM catalog 
    JOIN users ON catalog.sellerid = users.id 
    WHERE catalog.id = ?
";

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

$product = $result->fetch_assoc(); // Fetch product and seller data


$stmt->close();
$conn->close();
?>
