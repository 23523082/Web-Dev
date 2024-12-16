<!DOCTYPE html>
<html>
<head>
    <title>View Catalog</title>
</head>
<body>
    <h1>Catalog</h1>

    <?php
  require  'dbconnections.php';


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve data from the database
    $sql = "SELECT * FROM catalog";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>ID</th>
                <th>Seller ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Material</th>
                <th>Color</th>
                <th>Size</th>
                <th>Design</th>
                <th>type</th>
            </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["sellerid"]."</td>
                <td>".$row["title"]."</td>
                <td><img src='uploads/".$row["image"]."' width='100'></td>
                <td>".$row["description"]."</td>
                <td>".$row["material"]."</td>
                <td>".$row["color"]."</td>
                <td>".$row["size"]."</td>
                <td>".$row["design"]."</td>
                <td>".$row["type"]."</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

</body>
</html>