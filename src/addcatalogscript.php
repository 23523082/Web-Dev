<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'dbconnections.php'; // Include your database connection

    $sellerid = $_POST['sellerid'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $material = $_POST['material'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $design = $_POST['design'];
    $type = $_POST['type'];


    // Handle image upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $imagePath = $uploadDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // Insert into database
    $sql = "INSERT INTO catalog (sellerid, title, image, description, material, color, size, design, type)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssss", $sellerid, $title, $image, $description, $material, $color, $size, $design, $type);

    if ($stmt->execute()) {
        echo "Catalog entry added successfully!";
        header("Location: viewcatalog.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
