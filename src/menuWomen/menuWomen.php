<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Navbar Dropdown</title>
    <link rel="stylesheet" href="menuWomen.css" />
  </head>

  <body>
    <!-- Navbar -->
    <header>
      <nav class="navbar fixed-navbar">
        <div class="logo">
          <a href="index.html">BAJU BEKAS</a>
        </div>
        <ul class="nav-links">
          <li><a href="#">Shop</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Search</a></li>
          <li class="dropdown">
            <a href="#" class="menu-link">Menu</a>
            <ul class="dropdown-menu">
              <li><a href="menuMan.html">Men</a></li>
              <li><a href="menuChild.html">Children</a></li>
              <li><a href="handBags.html">Handbags</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <?php
      require '../dbconnections.php';

      $sql = "SELECT title, image FROM catalog WHERE type = 'women'";
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
      </div>
    </section>
    <!-- Baju Cewek -->

    <!-- Footer -->
    <footer class="footer">
      <div class="footer-container">
        <div class="footer-logo">
          <h2>BAJU BEKAS</h2>
        </div>
        <div class="footer-links">
          <div class="footer-column">
            <h3>Products</h3>
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
              <li><a href="menuWomen.css"></a>Selling Fashion for Women</li>
              <li><a href="menuChild.html">Selling Fashion for Children</a></li>
              <li><a href="handBags.html">Selling Handbags</a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3>Contact Information</h3>
            <p>Kaliurang St No.Km. 14,5, Krawitan, Umbulmartani, Ngemplak, Sleman Regency, Special Region of Yogyakarta 55584</p>
          </div>
        </div>
        <div class="footer-social">
          <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/facebook--v1.png" alt="Facebook" /></a>
          <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/twitter.png" alt="Twitter" /></a>
          <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new.png" alt="Instagram" /></a>
        </div>
      </div>
    </footer>
    <!-- Footer -->
  </body>
</html>
