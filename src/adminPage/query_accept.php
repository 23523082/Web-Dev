    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require '../dbconnections.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if 'id' is provided in the POST request
        if (!isset($_POST['id'])) {
            echo "Missing 'id' in POST request.";
            exit;
        }

        $queryId = intval($_POST['id']); // Sanitize the input

        // Step 1: Retrieve the query details from querycatalog
        $sql_query = "SELECT * FROM querycatalog WHERE id = ?";
        $stmt = $conn->prepare($sql_query);
        $stmt->bind_param("i", $queryId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Step 2: Insert the retrieved data into the catalog table
            $sql_insert = "INSERT INTO catalog (sellerid, title, image, description, material, color, size, design, type, price) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql_insert);

            if (!$stmt) {
                echo "Insert SQL Error: " . $conn->error;
                exit;
            }

            $stmt->bind_param(
                "isssssssss",
                $row['sellerid'],
                $row['title'],
                $row['image'],
                $row['description'],
                $row['material'],
                $row['color'],
                $row['size'],
                $row['design'],
                $row['type'],   
                $row['price'] // Assuming 'price' is present in the querycatalog table
            );
            $stmt->execute();

            // Step 3: Delete the query from querycatalog
            $sql_delete = "DELETE FROM querycatalog WHERE id = ?";
            $stmt = $conn->prepare($sql_delete);
            $stmt->bind_param("i", $queryId);
            $stmt->execute();

            echo "success";
        } else {
            echo "Query not found.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid request. Method used: " . $_SERVER['REQUEST_METHOD'];
    }
    ?>
