<?php
session_start();
require '../dbconnections.php';

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    die("Error: User is not logged in.");
}

$userId = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch POST data
    $country = $_POST['country'] ?? null;
    $prefix = $_POST['prefix'] ?? null;
    $address = $_POST['address'] ?? null;
    $post_code = $_POST['post-code'] ?? null;
    $city = $_POST['city'] ?? null;

    // Validate required fields
    if (!$country || !$address || !$post_code || !$city) {
        die("Error: All required fields must be filled.");
    }

    // Check if address already exists
    $checkQuery = $conn->prepare("SELECT id FROM addresses WHERE user_id = ?");
    $checkQuery->bind_param("i", $userId);
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result();

    if ($checkResult->num_rows > 0) {
        // Update existing address
        $updateQuery = $conn->prepare("UPDATE addresses SET country = ?, prefix = ?, address = ?, post_code = ?, city = ? WHERE user_id = ?");
        $updateQuery->bind_param("sssssi", $country, $prefix, $address, $post_code, $city, $userId);
        $updateQuery->execute();
        $updateQuery->close();
    } else {
        // Insert new address
        $insertQuery = $conn->prepare("INSERT INTO addresses (user_id, country, prefix, address, post_code, city) VALUES (?, ?, ?, ?, ?, ?)");
        $insertQuery->bind_param("isssss", $userId, $country, $prefix, $address, $post_code, $city);
        $insertQuery->execute();
        $insertQuery->close();
    }

    $checkQuery->close();
    $conn->close();

    // Redirect back to addresses page
    header("Location: addresses.php");
    exit;
} else {
    die("Error: Invalid request method.");
}
