<?php
function getRandomImageByType($type) {
    require 'dbconnections.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT image FROM catalog WHERE type = '$type' ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $imageName = $row['image']; // Get the image filename from the database
        $imagePath = "../uploads/{$imageName}"; // Construct the full image path using string interpolation
        mysqli_close($conn);
        return $imagePath;
    } else {
        mysqli_close($conn);
        return "No image found for type '{$type}'"; // Use string interpolation here as well
    }
}
