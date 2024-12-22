<?php
session_start();
require '../dbconnections.php'; // Replace with your actual database connection file

if (!isset($_SESSION['id'])) {
    die("User not logged in.");
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Fetch product details from the products table
    $stmt = $conn->prepare("SELECT * FROM catalog WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        die("Product not found.");
    }

    // Check if the entry already exists in the orders table
    $stmt_check = $conn->prepare("SELECT * FROM orders WHERE orderby = ? AND image = ? AND title = ? AND color = ? AND size = ? AND price = ?");
    $stmt_check->bind_param(
        "issssd",
        $_SESSION['id'],
        $product['image'],
        $product['title'],
        $product['color'],
        $product['size'],
        $product['price']
    );
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // If the entry already exists, show an alert and stop further logic
        echo "<script>alert('This product is already in your orders.'); window.location.href = 'viewcatalog.php';</script>";
        exit;
    }

    // Insert product details into the orders table
    $stmt_insert = $conn->prepare("INSERT INTO orders (orderby, image, title, color, size, price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_insert->bind_param(
        "issssd",
        $_SESSION['id'], // User ID from session
        $product['image'], // Product image
        $product['title'], // Product title
        $product['color'], // Product color
        $product['size'],  // Product size
        $product['price']  // Product price
    );

    if ($stmt_insert->execute()) {
        // Show a success alert and redirect to another page
        echo "<script>alert('Product added to your orders successfully!'); window.location.href = '../index.php';</script>";
    } else {
        echo "Error: " . $stmt_insert->error;
    }

    // Close the prepared statements
    $stmt_check->close();
    $stmt_insert->close();
    $stmt->close();
} else {
    die("Invalid product ID.");
}

// Close the database connection
$conn->close();
?>
