<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Navbar Dropdown</title>
    <link rel="stylesheet" href="menuMan.css" />
  </head>

  <body>
        <header>
      <nav class="navbar fixed-navbar">
        <div class="logo">
          <a href="../index.php">BAJU BEKAS</a>
        </div>
        <ul class="nav-links">
          <li><a href="#">Shop</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Search</a></li>
          <li class="dropdown">
            <a href="#" class="menu-link">Menu</a>
            <ul class="dropdown-menu">
              <li><a href="../menuWomen/menuWomen.php">Women</a></li>
              <li><a href="../menuKid/menuChild.php">Children</a></li>
              <li><a href="handBags.html">Handbags</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
        <?php
      require '../dbconnections.php';

      $sql = "SELECT title, image FROM catalog WHERE type = 'men'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {
              echo '<section class="baju-cowok">
              <div class="cards-container">
                  <a href="payMen1.html" target="_blank" class="card">
                       <img src="../uploads/' . $row["image"] . '" alt="' . $row["title"] . ' - Baju Cowok" />
                  </a>
              </div>
          </section>';
          }
      } else {
          echo "No results";
      }

      mysqli_close($conn);
  ?>
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
              <li