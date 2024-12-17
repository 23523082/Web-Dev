    <?php

    session_start();

    // Database connection (replace with your actual credentials)
    require '../dbconnections.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if admin is logged in
    if (!isset($_SESSION['email'])) {
        header("Location: login.php"); // Redirect to login page if not logged in
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
    </head>
    <body>

    <h2>Admin Dashboard</h2>
    <p>Welcome, <?php echo $row_admin['FirstName'] . ' ' . $row_admin['LastName']; ?></p>
    <a href="../Logout.php">Logout</a>
    <a href="catalogadmin.php">catalog-tobe-accepted</a>

    <h3>User List</h3>
    <table border="1">
    <tr>
        <th>Email</th>
        <th>Password</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Type</th>
        <th>Actions</th>
    </tr>

    <?php
    $sql_users = "SELECT email, password, FirstName, LastName, type FROM users";
    $result_users = $conn->query($sql_users);

    if ($result_users->num_rows > 0) {
        while($row_user = $result_users->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row_user["email"] . "</td>";
            echo "<td>" . $row_user["password"] . "</td>"; // Displaying password for demonstration, hash in production
            echo "<td>" . $row_user["FirstName"] . "</td>";
            echo "<td>" . $row_user["LastName"] . "</td>";
            echo "<td>" . $row_user["type"] . "</td>";
            echo '<td><a href="#" onclick="deleteUser(\'' . $row_user["email"] . '\')">Delete</a></td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No users found.</td></tr>";
    }
    ?>
    </table>

    <h3>Catalog List</h3>
    <table border="1">
    <tr>
        <th>id</th>
        <th>sellerid</th>
        <th>title</th>
        <th>image</th>
        <th>description</th>
        <th>material</th>
        <th>color</th>
        <th>size</th>
        <th>design</th>
        <th>type</th>
        <th>Actions</th>
    </tr>

    <?php
    $sql_catalog = "SELECT * FROM catalog"; // Replace with your actual table name
    $result_catalog = $conn->query($sql_catalog);

    if ($result_catalog->num_rows > 0) {
        while($row_catalog = $result_catalog->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row_catalog["id"] . "</td>";
            echo "<td>" . $row_catalog["sellerid"] . "</td>";
            echo "<td>" . $row_catalog["title"] . "</td>";
            echo "<td> <img src='../uploads/".$row_catalog["image"]."' width='100'></td>"; // Display image name
            echo "<td>" . $row_catalog["description"] . "</td>";
            echo "<td>" . $row_catalog["material"] . "</td>";
            echo "<td>" . $row_catalog["color"] . "</td>";
            echo "<td>" . $row_catalog["size"] . "</td>";
            echo "<td>" . $row_catalog["design"] . "</td>";
            echo "<td>" . $row_catalog["type"] . "</td>";
            echo '<td><a href="#" onclick="deleteCatalog(' . $row_catalog["id"] . ')">Delete</a></td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='11'>No catalog items found.</td></tr>";
    }
    ?>
    </table>

    <script>
    function deleteUser(email) {
        if (confirm("Are you sure you want to delete this user?")) {
            // Send AJAX request to delete user (implement this function)
            // ...
        }
    }

    function deleteCatalog(id) {
        if (confirm("Are you sure you want to delete this catalog item?")) {
            // Send AJAX request to delete catalog item (implement this function)
            // ...
        }
    }
    </script>

    </body>
    </html>

    <?php
    $conn->close();
    ?>