<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['id']) || !isset($_SESSION['type'])) {
    header("Location: account-section/login.php");
    exit;
}

require '../dbconnections.php'; // Include your database connection

// Check if the search query is set
if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];
    
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, title, image FROM catalog WHERE title LIKE ?");
    $searchTerm = "%" . $searchQuery . "%"; // Use wildcards for partial matches
    $stmt->bind_param("s", $searchTerm);
    
    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch results
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row; // Fetch all columns (id, title, image)
    }
    
    // Close the statement
    $stmt->close();
} else {
    $items = []; // No search query provided
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Baju Bekas</title>
    <link rel="stylesheet" href="searchResultstyle.css">
</head>
<body>

<header>
    <div>BAJU BEKAS</div>
    <nav>
        <a href="../index.php">Home</a>
        <a href="#">Products</a>
        <a href="../aboutUs/aboutUs.html">About</a>
    </nav>
    <div class="icons">
        <a href="../profile section/mainProfile.php">&#128100;</a>
        <a href="#">&#128722;</a>
    </div>
</header>

<div class="search-results">
    <h2>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>
    <?php if (count($items) > 0): ?>
        <ul class="results-list">
            <?php foreach ($items as $item): ?>
                <li class="result-item">
                    <a href="../viewcatalog/payMen1.php?id=<?php echo $item['id']; ?>" class="result-link">
                        <div class="result-content">
                            <img src="../uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="result-image">
                            <span class="result-title"><?php echo htmlspecialchars($item['title']); ?></span>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
</div>

<footer>
    <div>
        <h3>BAJU BEKAS</h3>
        <p>Our Main Products</p>
        <a href="../menuMan/menuMan.php">Men Fashion</a>
        <a href="../menuWomen/menuWomen.php">Women Fashion</a>
        <a href="../menuChild/menuChild.php">Children Fashion</a>
        <a href="../menuBag/handBags.php">Handbags Fashion</a>
    </div>
    <div>
        <h3>Services</h3>
        <a href="../menuMan/menuMan.php">Selling Fashion for Men</a>
        <a href="../menuWomen/menuWomen.php">Selling Fashion for Women</a>
        <a href="../menuChild/menuChild.php">Selling Fashion for Children</a>
        <a href="../menuBag/handBags.php">Selling Handbags</a>
    </div>
    <div>
        <h3>Contact Information</h3>
        <p>Kaliurang St No.Km. 14,5, Krawitan, Umbulmartani,<br> Ngemplak, Sleman Regency, Special Region of Yogyakarta 55584</p>
        <a href="#">&#x1F426; Twitter</a>
        <a href="#">&#x1F4F7; Instagram</a>
        <a href="#">&#x1F466; Facebook</a>
    </div>
</footer>

</body>
</html>
