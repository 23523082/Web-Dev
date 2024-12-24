<?php


require '../dbconnections.php';

session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['id']) || $_SESSION['type'] !== 'seller') {
      header("Location: ../index.php");
       exit;
      }


// Get form data
$sellerid = $_SESSION['id'];
$title = $_POST['title'];
$image = $_FILES['image']['name'];
$description = $_POST['description'];
$material = $_POST['material'];
$color = $_POST['color'];
$size = $_POST['size'];
$design = $_POST['design'];
$type = $_POST['type'];
$price = $_POST['price'];
// Prepare and bind the SQL statement
$sql = "INSERT INTO querycatalog (sellerid, title, image, description, material, color, size, design, type, price) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssssssss", $_SESSION['id'], $title, $image, $description, $material, $color, $size, $design, $type, $price);


$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    exit;
}

// Check file size
if ($_FILES["image"]["size"] > 52428800) { // Adjust maximum file size as needed
    echo "Sorry, your file is too large.";
    exit;
}

// Check file type
if (!in_array(strtolower(pathinfo($target_file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
    echo "Sorry, only JPG, JPEG, PNG, GIF, and BMP files are allowed.";
    exit;
}

// Attempt to move the uploaded file
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    // Insert data into the database
    // ... (database insertion code)
    echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    header("Location: ../viewcatalog.php");
} else {
    echo "Sorry, there was an error uploading your file.";
}

$stmt->execute();

echo "New record created successfully,please wait for it to be accpeted by adminstrator.";

$stmt->close();
$conn->close();
?>