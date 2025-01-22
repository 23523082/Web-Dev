<?php
session_start();
require_once '../dbconnections.php';

// Ensure the user is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
    echo "User is not logged in.";
    exit;
}

$userId = $_SESSION['id']; // Get user ID from session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['item_title'], $_POST['item_price'], $_POST['item_sellerid']) &&
        is_array($_POST['item_title']) &&
        is_array($_POST['item_price']) &&
        is_array($_POST['item_sellerid'])
    ) {
        $checkoutItems = [
            'titles' => $_POST['item_title'],
            'prices' => $_POST['item_price'],
            'sellerIds' => $_POST['item_sellerid']
        ];

        try {
            $insertQuery = "INSERT INTO orderhistory (title, price, buyby, selledby) VALUES (?, ?, ?, ?)"; 
            $insertStmt = $conn->prepare($insertQuery);
            
            if (!$insertStmt) {
                $_SESSION['payment_message'] = "Failed to prepare insert statement.";
                header("Location: maincart.php");
                exit;
            }

            $deleteQuery = "DELETE FROM orders WHERE title = ? AND price = ? AND orderby = ?";
            $deleteStmt = $conn->prepare($deleteQuery);

            if (!$deleteStmt) {
                $_SESSION['payment_message'] = "Failed to prepare delete statement.";
                header("Location: maincart.php");
                exit;
            }

            // Loop through the items
            foreach ($checkoutItems['titles'] as $index => $title) {
                $price = floatval($checkoutItems['prices'][$index]); // Convert price to float
                $sellerId = $checkoutItems['sellerIds'][$index];

                // Check if the sellerId exists in the catalog table
                $checkSellerQuery = "SELECT COUNT(*) FROM catalog WHERE sellerid = ?";
                $checkSellerStmt = $conn->prepare($checkSellerQuery);
                $checkSellerStmt->bind_param("i", $sellerId);
                $checkSellerStmt->execute();
                $checkSellerStmt->bind_result($sellerExists);
                $checkSellerStmt->fetch();
                $checkSellerStmt->close();

                // If the seller doesn't exist, skip this item or handle error
                if ($sellerExists == 0) {
                    continue; // Skip to the next item
                }

                // Insert into orderhistory
                $insertStmt->bind_param("sdii", $title, $price, $userId, $sellerId);
                if (!$insertStmt->execute()) {
                    $_SESSION['payment_message'] = "Error inserting data for item: $title.";
                    header("Location: maincart.php");
                    exit;
                }

                // Delete from orders
                $deleteStmt->bind_param("sdi", $title, $price, $userId);
                if (!$deleteStmt->execute()) {
                    $_SESSION['payment_message'] = "Error deleting data for item: $title.";
                    header("Location: ../cart-section/maincart.php");
                    exit;
                }
            }

            // Clear session checkout items
            unset($_SESSION['checkout_items']);
            $_SESSION['payment_message'] = "Transaction completed successfully!";
            header("Location: ../cart-section/maincart.php");
            exit;

        } catch (Exception $e) {
            // Handle exception
            $_SESSION['payment_message'] = "Exception: " . $e->getMessage();
            header("Location: ../cart-section/maincart.php");
            exit;
        } finally {
            // Clean up: Close prepared statements and the DB connection
            if (isset($insertStmt)) $insertStmt->close();
            if (isset($deleteStmt)) $deleteStmt->close();
            if (isset($conn)) $conn->close();
        }
    } else {
        // Handle missing or invalid POST data
        $_SESSION['payment_message'] = "Invalid or missing POST data.";
        header("Location: ../cart-section/maincart.phpp");
        exit;
    }
} else {
    // Handle invalid request method
    $_SESSION['payment_message'] = "Invalid request method.";
    header("Location: ../cart-section/maincart.php");
    exit;
}
?>
