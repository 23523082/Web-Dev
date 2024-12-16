<?php
// Check if user is logged i
$servername = 'localhost';
$username = 'Vibe';
$password = null; // Make sure to secure this file
$dbname = 'bajubekas';

// Establish a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection and handle errors
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
} else {
    echo "Database connection successful.";
}
?>

