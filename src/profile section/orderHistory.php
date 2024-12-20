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
    <link rel="stylesheet" href="orderHistory.css" />
    <title>Baju Bekas - Profile</title>
  </head>
  <body>
    <!-- header section -->
    <header>
      <nav class="navbar">
        <div class="navbar-container">
          <!-- Shop Icon -->
          <div class="shop-icon">
            <a href="#"
              ><img src="img_profile/shop_icon.png" alt="Shop Icon"
            /></a>
          </div>
          <!-- Logo -->
          <div class="logo">
            <a href="../index.html"
              ><img src="img_profile/Logo_Icon.png" alt="Baju Bekas Logo"
            /></a>
          </div>
          <!-- Navigation Icons -->
          <div class="nav-icons">
            <div class="search-icon">
              <a href="#"
                ><img src="img_profile/icon_search.png" alt="Search Icon"
              /></a>
            </div>
            <div class="profile-icon">
              <a href="mainProfile.html"
                ><img src="img_profile/icon_profile.png" alt="Profile Icon"
              /></a>
            </div>
            <div class="menu-icon" onclick="toggleMenu()">
              <img src="img_profile/icon_menu.png" alt="Menu Icon" />
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
          <!-- Add this overlay element just inside the <body> -->
          <div id="overlay" class="overlay hidden" onclick="toggleMenu()"></div>
        </div>
      </nav>
    </header>
    <div class="user-header">
      <div class="user-background">
        <div class="overlay"></div>
        <img
          src="img_profile/WhatsApp Image 2024-11-22 at 04.26.10.jpeg"
          alt="User Background"
        />
      </div>
      <h1 class="user-name">WELCOME BUDIONO SIREGAR</h1>
    </div>
    <!-- main section -->
    <main>
      <section class="orderHistory-section">
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
        <div class="main-content">s
          <!-- Title and Subtitle -->
          <div class="title-section">
            <h2 class="section-title">ORDER HISTORY</h2>
            <p class="section-subtitle">
              MR. BUDIONO SIREGAR HERE YOU WILL FOUND YOUR PRODUCT HISTORY FROM
              YOUR CHECKOUT
            </p>
          </div>
          <!-- Content -->
          <div class="order-history-content">
            <div class="filters">
              <select
                class="filter"
                name="filter-days"
                onclick="toggleFilterMenu('days')"
              >
                <option value="">FILTER DAYS</option>
                <option value="7">Last 7 Days</option>
                <option value="30">Last 30 Days</option>
                <option value="365">Last Year</option>
              </select>
              <select
                class="filter"
                name="filter-orders"
                onclick="toggleFilterMenu('orders')"
              >
                <option value="">FILTER ORDERS</option>
                <option value="completed">Completed</option>
                <option value="pending">Pending</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </div>
            <div class="history-status">
              <p>YOUR HISTORY STILL EMPTY</p>
            </div>
            <button class="find-product-btn">FIND PRODUCT NOW</button>
          </div>
        </div>
      </section>
    </main>
    <!-- Footer Section -->
    <footer class="footer-section">
      <div class="footer-container">
        <div class="footer-brand">
          <!-- Logo Section -->
          <div class="footer-logo">
            <img src="img_profile/Logo_Icon.png" alt="Baju Bekas Logo" />
          </div>
          <!-- Social Media Icons -->
          <div class="social-icons">
            <img src="img_profile/instagram_icon.png" alt="Instagram Icon" />
          </div>
        </div>
        <div class="footer-links">
          <div class="footer-column">
            <h4>Products</h4>
            <ul>
              <li>Sand Stone</li>
              <li>Stone</li>
              <li>Cement</li>
              <li>Soft Stone</li>
            </ul>
          </div>
          <div class="footer-column">
            <h4>Services</h4>
            <ul>
              <li>Measurement Service</li>
              <li>Product Advice</li>
              <li>Interior Design</li>
            </ul>
          </div>
          <div class="footer-column">
            <h4>Contact Information</h4>
            <address>
              3181 Al Imam Saud Ibn Abdul Aziz Branch Rd,<br />
              An Nuzhah, Riyadh 12474,<br />
              Saudi Arabia
            </address>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p class="footer-copyright">Copyright © 2022 | All Rights Reserved.</p>
        <p class="footer-created">Created with love by Five_Mushketeer</p>
      </div>
    </footer>
    <script src="orderHistory.js"></script>
  </body>
</html>
