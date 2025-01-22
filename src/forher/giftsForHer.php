<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['id']) || !isset($_SESSION['type'])) {
  header("Location: account-section/login.php");
  exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Dropdown</title>
  <link rel="stylesheet" href="giftsForHer.css">
</head>
<body>
  <!-- Navbar -->
  <header>
    <nav class="navbar fixed-navbar">
      <div class="logo">
        <a href="../index.php">BAJU BEKAS</a>
      </div>
      <ul class="nav-links">
        <li><a href="../index.php">Shop</a></li>
        <li><a href="../profile section/mainProfile.php">Profile</a></li>
        <li><a href="../search/search.php">Search</a></li>
        <li class="dropdown">
          <a href="#" class="menu-link">Menu</a>
          <ul class="dropdown-menu">
            <li><a href="../menuMan/menuMan.php">Men</a></li>
            <li><a href="../menuWomen/menuWomen.php">Women</a></li>
            <li><a href="../menuChild/menuChild.php">Children</a></li>
            <li><a href="../menuBag/handBags.php">Handbags</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
  <!-- Navbar -->

  <!-- Gifts for Him -->
  <section class="baju-cowok">
    <div class="cards-container">
      <?php
      require '../dbconnections.php';

      // Query to fetch items with type 'men' or 'bag'
      $sql = "SELECT * FROM catalog WHERE type IN ('women', 'bag')";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Output each item as a card
        while ($row = $result->fetch_assoc()) {
          echo '<a href="../viewcatalog/payMen1.php?id=' . $row['id'] . '"" target="_blank" class="card">';
          echo '<h3>'. htmlspecialchars($row['title']). '</h3>';
          echo '<img src="../uploads/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '">';
          echo '</a>';
        }
      } else {
        echo "<p>No items available.</p>";
      }

      // Close connection
      $conn->close();
      ?>
    </div>
  </section>
  <!-- Gifts for Him -->

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-logo">
        <h2>BAJU BEKAS</h2>
      </div>
      <div class="footer-links">
        <div class="footer-column">
          <h3>Our Main Products</h3>
          <ul>
            <li><a href="menuMan.html">Men Fashion Product</a></li>
            <li><a href="menuWomen.html">Women Fashion Product</a></li>
            <li><a href="menuChild.html">Children Fashion Product</a></li>
            <li><a href="handBags.html">Handbags Fashion Product</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Services</h3>
          <ul>
            <li><a href="menuMan.html">Selling Fashion for Men</a></li>
            <li><a href="menuWomen.html">Selling Fashion for Women</a></li>
            <li><a href="menuChild.css">Selling Fashion for Children</a></li>
            <li><a href="handBags.html">Selling Handbags</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Contact Information</h3>
          <p>Kaliurang St No.Km. 14,5, Krawitan, Umbulmartani, Ngemplak, Sleman Regency, Special Region of Yogyakarta 55584</p>
        </div>
      </div>
      <div class="footer-social">
        <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/facebook--v1.png" alt="Facebook"></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/twitter.png" alt="Twitter"></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new.png" alt="Instagram"></a>
      </div>
    </div>
  </footer>
  <!-- Footer -->
</body>
</html>
