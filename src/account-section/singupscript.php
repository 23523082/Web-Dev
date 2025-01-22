<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../dbconnections.php'; // Ensure this file sets up $conn for the connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "Form submitted.<br>";

    // Collect form data
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $FirstName = trim($_POST['first-name']);
    $LastName = trim($_POST['last-name']);
    $DOB = $_POST['dob'];
    $type = $_POST['user-type'];

    // Validate input
    if (empty($email) || empty($password) || empty($FirstName) || empty($LastName) || empty($DOB) || empty($type)) {
        echo "<script>alert('All fields are required. Please fill out the form completely.');</script>";
        exit;
    }

        // Check if email exists
        $checkEmailSQL = "SELECT email FROM users WHERE email = ?";
        if ($checkStmt = $conn->prepare($checkEmailSQL)) {
            echo "Email check query prepared successfully.<br>";
            $checkStmt->bind_param("s", $email);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                echo "<script>alert('This email is already registered.');</script>";
                $checkStmt->close();
                exit;
            }
            echo "Email is not registered. Proceeding.<br>";
            $checkStmt->close();
        } else {
            die("Error preparing email check query: " . $conn->error);
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        echo "Password hashed successfully.<br>";

        // Insert into database
        $sql = "INSERT INTO users  (email, password, FirstName, LastName, DOB, type)
                VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            echo "Insert query prepared successfully.<br>";
            $stmt->bind_param("ssssss", $email, $hashedPassword, $FirstName, $LastName, $DOB, $type);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Sign-up successful! Welcome, $FirstName!');
                        window.location.href = 'login.php'; // Redirect to home page
                      </script>";
                exit;
            } else {
                die("Error executing insert query: " . $stmt->error);
            }
        } else {
            die("Error preparing insert query: " . $conn->error);
        }
   
    }

?>
