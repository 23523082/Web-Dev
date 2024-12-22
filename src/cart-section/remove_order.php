<?php
// Start the session and include database connection
session_start();
include '../dbconnections.php'; // Replace with your actual database connection file

header('Content-Type: application/json'); // Return JSON response

$response = [];

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the input

    // Prepare the SQL query to delete the item
    $query = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $id); // Bind the item ID to the query

        // Execute the query
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response['success'] = true;
                $response['message'] = "Item successfully removed!";
            } else {
                $response['success'] = false;
                $response['message'] = "Item not found or already deleted.";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Failed to delete item: " . $stmt->error;
        }

        $stmt->close(); // Close the prepared statement
    } else {
        $response['success'] = false;
        $response['message'] = "Failed to prepare the query: " . $conn->error;
    }

    $conn->close(); // Close the database connection
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request. Item ID is missing or invalid.";
}

// Send the JSON response
echo json_encode($response);
exit();
?>
