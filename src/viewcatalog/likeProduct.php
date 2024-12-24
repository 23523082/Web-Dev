<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../dbconnections.php'; // Include your database connection here

    // Retrieve the POST data
    $id = $_POST['id'] ?? null;

    if ($id === null) {
        die("Error: Product ID is missing.");
    }

    // Update likes for the specified ID
    $stmt = $conn->prepare("UPDATE catalog SET likes = likes + 1 WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        // Reload the page on success
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        $stmt->close();
        $conn->close();
        die("Error: Failed to add like.");
    }
} else {
    die("Error: Invalid request method.");
}
