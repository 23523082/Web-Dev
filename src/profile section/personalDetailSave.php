<?php
session_start();

require '../dbconnections.php';

// Check connection
if (!isset($_SESSION['email']) || !isset($_SESSION['id']) || !isset($_SESSION['type'])) {
  }
$user_id = $_SESSION['id']; 
// Get user ID from session


// Collect form data
$title = isset($_POST['title']) ? $_POST['title'] : "";
$first_name = isset($_POST['first-name']) ? $_POST['first-name'] : "";
$last_name = isset($_POST['last-name']) ? $_POST['last-name'] : "";
$country = isset($_POST['country']) ? $_POST['country'] : "";
$dob = isset($_POST['dob']) ? $_POST['dob'] : "";

// Update or insert into users table
$user_query = "INSERT INTO users (id, FirstName, LastName, DOB) VALUES (?, ?, ?, ?) 
                ON DUPLICATE KEY UPDATE FirstName = VALUES(FirstName), LastName = VALUES(LastName), DOB = VALUES(DOB)";
if ($stmt = $conn->prepare($user_query)) {
    $stmt->bind_param("isss", $user_id, $first_name, $last_name, $dob);
    if (!$stmt->execute()) {
        echo "Error updating user details: " . $stmt->error;
    }
    $stmt->close();
}

// Update or insert into addresses table
if (!empty($country)) {
    $address_query = "INSERT INTO addresses (user_id, country) VALUES (?, ?) 
                      ON DUPLICATE KEY UPDATE country = VALUES(country)";
    if ($stmt = $conn->prepare($address_query)) {
        $stmt->bind_param("is", $user_id, $country);
        if (!$stmt->execute()) {
            echo "Error updating address: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Redirect back to personal details page
header("Location: personalDetails.php");
exit();


?>
