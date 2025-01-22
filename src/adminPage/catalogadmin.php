<?php
session_start();

// Database connection (replace with your actual credentials)
require '../dbconnections.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if admin is logged in
if (!isset($_SESSION['email'])) {
    header("Location: account-section/login.php"); // Redirect to login page if not logged in
    exit();
}

// Get current admin's information
$email = $_SESSION['email'];
$sql_admin = "SELECT email, password, FirstName, LastName, type FROM users WHERE email = '$email'";
$result_admin = $conn->query($sql_admin);

if ($result_admin->num_rows > 0) {
    $row_admin = $result_admin->fetch_assoc();
    $admin_type = $row_admin['type']; 

    // Check if admin has the required type (e.g., 'admin' or 'super_admin')
    if ($admin_type != 'admin') { 
        header("Location: not_authorized.php"); // Redirect if not authorized
        exit();
    }
} else {
    // Handle case where admin email is not found in the database
    header("Location: not_authorized.php"); // Redirect if not authorized
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet"  href= "adminstyle.css" />
</head>
<body>

<h2>Admin Dashboard</h2>
<p>Welcome, <?php echo $row_admin['FirstName'] . ' ' . $row_admin['LastName']; ?></p>
<a href="../Logout.php">Logout</a>


<h3>Catalog Query List</h3>
<table border="1">
<tr>
    <th>id</th>
    <th>sellerid</th>
    <th>title</th>
    <th>description</th>
    <th>material</th>
    <th>color</th>
    <th>size</th>
    <th>design</th>
    <th>type</th>
    <th>price</th>
    <th>Actions</th>
</tr>

<?php
$sql_querycatalog = "SELECT * FROM querycatalog"; // Replace with your actual table name
$result_querycatalog = $conn->query($sql_querycatalog);

if ($result_querycatalog->num_rows > 0) {
    while($row_querycatalog = $result_querycatalog->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row_querycatalog["id"] . "</td>";
        echo "<td>" . $row_querycatalog["sellerid"] . "</td>";
        echo "<td>" . $row_querycatalog["title"] . "</td>";
        echo "<img src='../uploads/".$row["image"]."' width='100'></td>"; // Display image name
        echo "<td>" . $row_querycatalog["description"] . "</td>";
        echo "<td>" . $row_querycatalog["material"] . "</td>";
        echo "<td>" . $row_querycatalog["color"] . "</td>";
        echo "<td>" . $row_querycatalog["size"] . "</td>";
        echo "<td>" . $row_querycatalog["design"] . "</td>";
        echo "<td>" . $row_querycatalog["type"] . "</td>";
        echo "<td>" . $row_querycatalog["price"] . "</td>";
            
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='11'>No catalog queries found.</td></tr>";
}
?>
</table>

<script>
$.ajaxSetup({ cache: false });

function acceptQuery(id) {
    if (confirm("Are you sure you want to accept this catalog query?")) {
        // Send AJAX request to accept the query
        $.ajax({
            url: "query_accept.php",
            type: "POST",
            data: { id: id },
            success: function(response) {
                if (response.trim() === "success") {
                    alert("Query accepted successfully!");
                    // Reload the page to update the table
                    location.reload();
                } else {
                    alert("Error accepting query: " + response);
                }
            },
            error: function(xhr, status, error) {
                alert("AJAX Error: " + error);
            }
        });
    }
}
</script>

</body>
</html>

<?php
$conn->close();
?>