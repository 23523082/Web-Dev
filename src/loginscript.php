<?php
// Start session
session_start();

// Include the DB connection file
require 'dbconnections.php';

// Initialize error message variable
$error_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from POST data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to check if the email exists in the database
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If email exists, verify the password
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, redirect to a different page (e.g., dashboard)
            $_SESSION['user_id'] = $user['id']; // Store user info in session
            header("Location: main.php");
            exit(); // Make sure to stop execution after redirection
        } else {
            // Password is incorrect
            $error_message = "Incorrect password.";
        }
    } else {
        // Email not found
        $error_message = "No account found with that email address.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>