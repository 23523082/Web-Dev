<?php
session_start();
require_once '../dbconnections.php'; 

// Ensure the user is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
    header("Location: ../account-section/login.php");
    exit;
}

$userId = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve checkout items from the session
    if (isset($_SESSION['checkout_items'])) {
        $checkoutItems = $_SESSION['checkout_items'];

        try {
            // Prepare the insert query for orderhistory
            $insertQuery = "INSERT INTO orderhistory (title, price, selledby, buyby) VALUES (?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            if (!$insertStmt) {
                throw new Exception("Failed to prepare insert statement: " . $conn->error);
            }

            // Prepare the delete query for orders
            $deleteQuery = "DELETE FROM orders WHERE title = ? AND price = ? AND orderby = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            if (!$deleteStmt) {
                throw new Exception("Failed to prepare delete statement: " . $conn->error);
            }

            // Loop through the items, insert into orderhistory, and delete from orders
            foreach ($checkoutItems['titles'] as $index => $title) {
                $price = $checkoutItems['prices'][$index];
                $sellerId = $checkoutItems['sellerIds'][$index];

                // Insert into orderhistory
                $insertStmt->bind_param("ssii", $title, $price, $sellerId, $userId);
                if (!$insertStmt->execute()) {
                    throw new Exception("Failed to execute insert query: " . $insertStmt->error);
                }

                // Delete from orders
                $deleteStmt->bind_param("sdi", $title, $price, $userId);
                if (!$deleteStmt->execute()) {
                    throw new Exception("Failed to execute delete query: " . $deleteStmt->error);
                }
            }

            // Clear the session checkout items after successful operations
            unset($_SESSION['checkout_items']);

            // Redirect to a success page or confirmation message
            header("Location: payment_success.php");
            exit;
        } catch (Exception $e) {
            // Handle errors and redirect to an error page
            error_log($e->getMessage());
            header("Location: payment_error.php");
            exit;
        } finally {
            // Close the database connection
            if (isset($insertStmt)) {
                $insertStmt->close();
            }
            if (isset($deleteStmt)) {
                $deleteStmt->close();
            }
            if (isset($conn)) {
                $conn->close();
            }
        }
    } else {
        // No items in session, redirect back to the cart
        header("Location: ../cart-section/maincart.php");
        exit;
    }
} else {
    // Invalid access method
    header("Location: ../cart-section/maincart.php");
    exit;
}
?>
