<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "Vibe";
    $password = null;
    $dbname = "bajubekas";

    // Collect form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $dob = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Debugging: Check if form data is received
    echo "Received data: Email: $email, Password: $hashedPassword, Name: $firstName $lastName, DOB: $dob<br>";

    try {
        // Create a connection
        $conn = new mysqli($servername, $username, null, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to insert data into the user table
        $sql = "INSERT INTO user (email, password, FirstName, LastName, DOB, type)
                VALUES (?, ?, ?, ?, ?, 'customer')";

        // Prepare the SQL statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the form data to the SQL statement
            $stmt->bind_param("sssss", $email, $hashedPassword, $firstName, $lastName, $dob);

            // Execute the statement
            if ($stmt->execute()) {
                // Success message
                echo "<script>alert('Sign-up successful! Welcome, $firstName!');</script>";
            } else {
                // Output SQL error if execution fails
                echo "Error executing query: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            // Output error if prepare fails
            echo "Error preparing query: " . $conn->error;
        }

        // Close the connection
        $conn->close();
    } catch (Exception $e) {
        // Display any exceptions that occur
        echo "Error: " . $e->getMessage();
    }
}
?>
