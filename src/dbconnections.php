<?php
// db_connection.php
$conn = new mysqli('localhost', 'Vibe', null, 'bajubekas');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
