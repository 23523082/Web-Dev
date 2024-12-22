<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['id']) || !isset($_SESSION['type'])) {
  header("Location: account-section/login.php");
  exit;
}
require 'dbconnections.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Baju Bekas</title>

    <link rel="stylesheet" href="styles.css" />
  </head>
  <script>
    function toggleMenu() {
        var dropdown = document.getElementById("dropdown");
        dropdown.classList.toggle("show");
    }

    const user = {
      type: "<?php echo $_SESSION['type']; ?>" // Correctly echo the session variable
};

    function checkUsertype() {
        const addButton = document.getElementById('addButton');
        
        if (user.type !== 'seller') {
            addButton.style.display = 'none'; // Hide the Add button
        }
    }

    // Call the function on page load 
    window.onload = checkUsertype;
</script>
  <body>
    <!-- Navbar -->
    <nav class="navbar">
      <div class="navbar-left">
        <a href="aboutUs/aboutUs.html" class="nav-btn">About Us</a>
      </div>
      <div class="navbar-right">
        <a href="cart-section/maincart.php" class="nav-btn">cart</a>
        <a href="#" class="nav-btn">Shop</a>
        <a href="profile section/mainProfile.php" class="nav-btn">Profile</a>
        <a class="nav-btn" href="search/search.php">Search</a>
        <a id="addButton" href="addcatalog/addcatalog.php" class="nav-btn">Add</a>
        <a href ="Logout.php" class="nav-btn">Logout</a>
        <div class="menu-wrapper">
          <button class="nav-btn menu-btn" onclick="toggleMenu()">Menu</button>
          <div class="dropdown-menu" id="dropdown">
            <a href="HTML-TOBE-USED/newIn.html">New In</a>
            <a href="HTML-TOBE-USED/menuMan.html">Man</a>
            <a href="HTML-TOBE-USED/menuWomen.html">Women</a>
            <a href="HTML-TOBE-USED/menuChild.html">Children</a>
            <a href="HTML-TOBE-USED/handBags.html">Handbags</a>
          </div>
        </div>
      </div>
    </nav>
    <!-- Navbar -->

    <!-- Hero Section -->
    <div class="hero">
      <h1 class="hero-title">BAJU BEKAS</h1>
      <div class="hero-content-wrapper">
        <p class="hero-subtitle">BAJU BEKAS by Three Musketeers</p>
        <button class="cta-btn" onclick="scrollToCategories()">Discover More</button>
      </div>
    </div>

    <script>
      function scrollToCategories() {
        document.querySelector(".categories").scrollIntoView({ behavior: "smooth" });
      }
    </script>
    <!-- Hero Section -->

    <!-- Categories Section -->
    <section class="categories">
      <h2 class="section-title">Explore Our Categories</h2>
      <div class="cards-wrapper">
        <div class="card">
          <a href="menuMan/menuMan.php">
            <img src=https://i.pinimg.com/736x/6e/2c/5b/6e2c5b6a332bf8111f78264e1e489d61.jpg alt="Men's Clothing" />
            <h3>Men</h3>
          </a>
        </div>
        <div class="card">
          <a href="menuWomen/menuWomen.php">
            <img src="https://images.unsplash.com/photo-1580651214613-f4692d6d138f?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDV8fHxlbnwwfHx8fHw%3D" alt="Women's Clothing" />
            <h3>Women</h3>
          </a>
        </div>  
        <div class="card">
          <a href="menuChild/menuChild.php">
            <img src="https://i.pinimg.com/736x/6a/ed/44/6aed444d727047b153a901b8130ac1ea.jpg" alt="Children's Clothing" />
            <h3>Children</h3>
          </a>
        </div>
        <div class="card">
          <a href="menuBag/handBags.php">
            <img src="https://i.pinimg.com/736x/d9/24/fd/d924fd272cbffa292f50774ee1b53ea5.jpg" alt="Handbags" />
            <h3>Handbags</h3>
          </a>
        </div>
      </div>
    </section>
    <!-- Categories Section -->

    <!-- New In -->
    <section class="featured">
      <div class="featured-wrapper">
        <a href="newIn/newIn.php" class="featured-card">
          <img src="https://i.pinimg.com/736x/a4/5f/b3/a45fb37b0f1ae35b4eabc1b613f38b1a.jpg" alt="Featured Item" />
        </a>
        <div class="featured-content">
          <h2>Step into Style: New In</h2>
          <p>Uncover a world of refined elegance with our exclusive new arrivals. Each piece is thoughtfully designed to offer unmatched quality, ensuring you stand out with confidence and grace.</p>
        </div>
      </div>
    </section>
    <!-- New In -->

    <!-- Gift Section -->
    <section class="gifts">
      <h2 class="section-title">Gift Ideas</h2>
      <div class="cards-wrapper">
        <div class="card">
          <a href="HTML-TOBE-USED/giftsForHim.html">
            <img src="https://i.pinimg.com/736x/bd/c2/b0/bdc2b0a898e27ffa0a72e2aa3993dfbd.jpg" alt="Gifts for Him" />
            <h3>Gifts for Him</h3>
          </a>
        </div>
        <div class="card">
          <a href="HTML-TOBE-USED/giftsForHer.html">
            <img src="https://i.pinimg.com/736x/e6/2a/ef/e62aef565ea268066a649f4a819ac779.jpg" alt="Gifts for Her" />
            <h3>Gifts for Her</h3>
          </a>
        </div>
      </div>
    </section>
    <!-- Gift Section -->

    <!-- Featured Section -->
    <section class="featured">
      <div class="featured-wrapper">
        <a href="HTML-TOBE-USED/featured.html" class="featured-card">
          <img src="https://i.pinimg.com/736x/e5/6c/14/e56c14a0d4c42e81b6eac227abb9252e.jpg" alt="Featured Item" />
          <h3></h3>
        </a>
        <div class="featured-content">
          <h2>Featured Collection</h2>
          <p>Explore our latest featured items carefully curated to suit every style. From timeless classics to modern essentials, find your perfect match here.</p>
        </div>
      </div>
    </section>
    <!-- Featured Section -->

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
              <li><a href="HTML-TOBE-USED/menuMan.html">Men Fashion</a></li>
              <li><a href="HTML-TOBE-USED/menuWomen.html">Women Fashion</a></li>
              <li><a href="HTML-TOBE-USED/menuChild.html">Children Fashion</a></li>
              <li><a href="HTML-TOBE-USED/handBags.html">Handbags Fashion</a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3>Services</h3>
            <ul>
              <li><a href="HTML-TOBE-USED/menuMan.html">Selling Fashion for Men</a></li>
              <li><a href="HTML-TOBE-USED/menuWomen.html"></a>Selling Fashion for Women</li>
              <li><a href="HTML-TOBE-USED/menuChild.html">Selling Fashion for Children</a></li>
              <li><a href="HTML-TOBE-USED/handBags.html">Selling Handbags</a></li>
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

    <!-- JavaScript -->
    <script>
      window.addEventListener("scroll", function () {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
          navbar.classList.add("scrolled");
          navbar.classList.remove("transparent");
        } else {
          navbar.classList.remove("scrolled");
          navbar.classList.add("transparent");
       

 }
      });

      // Set initial state
      document.addEventListener("DOMContentLoaded", function () {
        const navbar = document.querySelector(".navbar");
        navbar.classList.add("transparent");
      });
    </script>

    <!-- JavaScript -->
  </body>
</html>



