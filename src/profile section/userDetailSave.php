<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include database connection
    include '../dbconnections.php'; // Make sure to create this file with your DB connection code

    // Get the user ID from the hidden input
    $user_id = $_POST['user_id'];
    $new_email = $_POST['new-email'];
    $new_password = $_POST['new-password'];

    // Validate the new email and password
    if (filter_var($new_email, FILTER_VALIDATE_EMAIL) && !empty($new_password)) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Prepare the SQL statement to update the user's email and password
        $stmt = $conn->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssi", $new_email, $hashed_password, $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Set a session variable to indicate success
            $_SESSION['update_success'] = "User  details updated successfully.";
        } else {
            $_SESSION['update_error'] = "Error updating user details: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['update_error'] = "Invalid email or password.";
    }

    // Close the database connection
    $conn->close();

    // Redirect back to the same page
    header("Location: userDetails.php");
    exit();
}
?>