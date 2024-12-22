<?php 
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
  header("Location: account-section/login.php");
  exit;
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="recommendation.css" />
    <title>Baju Bekas - Profile</title>
  </head>
  <body>
    <!-- header section -->
    <header>
      <nav class="navbar">
        <div class="navbar-container">
          <!-- Shop Icon -->
          <div class="shop-icon">
            <a href="../index.php"
              ><img src="../img-source/shop_icon.png" alt="Shop Icon"
            /></a>
          </div>
          <!-- Logo -->
          <div class="logo">
            <a href="../index.php"
              ><img src="../img-source/Logo_Icon.png" alt="Baju Bekas Logo"
            /></a>
          </div>
          <!-- Navigation Icons -->
          <div class="nav-icons">
            <div class="search-icon">
              <a href="../search/search.php"
                ><img src="../img-source/icon_search.png" alt="Search Icon"
              /></a>
            </div>
            <div class="profile-icon">
              <a href="mainProfile.php"
                ><img src="../img-source/icon_profile.png" alt="Profile Icon"
              /></a>
            </div>
            <div class="menu-icon" onclick="toggleMenu()">
              <img src="../img-source/icon_menu.png" alt="Menu Icon" />
            </div>
          </div>
          <!-- Add this after the <div class="nav-icons"> -->
          <div id="menuBar" class="menu-bar hidden">
            <button class="close-menu" onclick="toggleMenu()">X</button>
            <ul class="menu-list">
              <li>New In</li>
              <li>Woman</li>
              <li>Man</li>
              <li>Child</li>
              <li>Handbags</li>
              <li>Gifts For Him</li>
              <li>Gifts For Her</li>
              <li>Payment Methods</li>
              <li>About Us</li>
            </ul>
          </div>
          <div id="overlay" class="overlay hidden" onclick="toggleMenu()"></div>
        </div>
      </nav>
    </header>
    <!-- main section -->
    <section class="user-header">
      <div class="user-background">
        <div class="overlay"></div>
        <img
          src="../img-source/WhatsApp Image 2024-11-22 at 04.26.10.jpeg"
          alt="User Background"
        />
      </div>
      <div class="main-content">
        <aside class="sidebar">
          <ul class="sidebar-menu">
            <li><a href="wishlistProfile.php">Wishlist</a></li>
            <li><a href="orderHistory.php">Order History</a></li>
            <li><a href="personalDetails.php?id=<?php echo $_SESSION['id']; ?>">Personal Details</a></li>
            <li><a href="userDetails.php">User Details</a></li>
            <li><a href="addresses.php?id=<?php echo $_SESSION['id']; ?>">Addresses</a></li>
            <li><a href="recommendation.php">Recommendation</a></li>
          </ul>
        </aside>
        <div class="recommendation-content">
          <h1 class="title">RECOMMENDATION FOR YOU,</h1>
          <p class="user-name">BUDIONO SIREGAR</p>
          <button type="button" class="discover-button">DISCOVER NOW</button>
        </div>
      </div>
    </section>
    <script src="recommendation.js"></script>
  </body>
</html>
