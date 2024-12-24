<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
  header("Location: account-section/login.php");
  exit;



}
require '../dbconnections.php';
  $userId = $_SESSION['id'];

// Fetch user's first name and last name
  $query = $conn->prepare("SELECT FirstName, LastName FROM users WHERE id = ?");
  $query->bind_param("i", $userId);
  $query->execute();
  $result = $query->get_result();

if ($result->num_rows > 0) {
    $userResult = $result->fetch_assoc(); // Fetch user data
} else {
    die("Error: User not found.");
}?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="mainProfile.css" />
    <title>Baju Bekas - Profile</title>
  </head>
  <body>
    <!-- Navbar -->
    <header>
      <nav class="navbar">
        <div class="navbar-container">
          <!-- Shop Icon -->
          <div class="shop-icon">
            <a href="../cart-section/maincart.php"
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
              <a href="../profile section/mainProfile.php"
                ><img src="../img-source/icon_profile.png" alt="Profile Icon"
              /></a>
            </div>
            <div class="addcatalog-icon" id="addButton">
              <a href="../addcatalog/addcatalog.php" class="nav-btn"
                ><img src="../img-source/add-catalog.png" alt="add Icon"
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
              <li><a href="../newIn/newIn.php">New In</a></li>
              <li><a href="../menuWomen/menuWomen.php">Women</a></li>
              <li><a href="../menuMan/menuMan.php">Man</a></li>
              <li><a href="../menuChild/menuChild.php">Child</a></li>
              <li><a href="../menuBag/handBags.php">Handbags</a></li>
              <li>
                <a href="../HTML-TOBE-USED/giftsForHim.html">Gifts For Him</a>
              </li>
              <li>
                <a href="../HTML-TOBE-USED/giftsForHer.html">Gifts For Her</a>
              </li>
              <li>
                <a href="../paymentMethod-section/mainPayment.html"
                  >Payment Methods</a
                >
              </li>
              <li><a href="../aboutUs/aboutUs.html">About Us</a></li>
              <li><a href="Logout.php" class="nav-btn">Logout</a></li>
            </ul>
          </div>
          <!-- Add this overlay element just inside the <body> -->
          <div id="overlay" class="overlay hidden" onclick="toggleMenu()"></div>
        </div>
      </nav>
    </header>
    <!-- Navbar -->
    <div class="user-header">
      <div class="user-background">
        <div class="overlay"></div>
        <img
          src="../img-source/WhatsApp Image 2024-11-22 at 04.26.10.jpeg"
          alt="User Background"
        />
      </div>
      <h1 class="user-name">WELCOME <?php echo htmlspecialchars($userResult['FirstName'] . ' ' . $userResult['LastName']); ?></h1>
    </div>

    <!-- Main Section -->
    <main class="main-section">
      <div class="main-content">
        <!-- Wishlist Section -->
        <div
          class="card"
          id="wishlist"
         onclick="window.location.href='wishlistProfile.php?id=<?php echo $_SESSION['id']; ?>'"
        >
          <img src="../img-source/model_pria.jpg" alt="Wishlist" />
          <button class="card-button">WISHLIST</button>
        </div>

        <div class="divider"></div>

        <!-- Order History Section -->
        <div
          class="card"
          id="order-history"
          onclick="window.location.href='orderHistory.php?id=<?php echo $_SESSION['id']; ?>';"
        >
          <img src="../img-source/model_wanita.jpg" alt="Order History" />
          <button class="card-button">ORDER HISTORY</button>
        </div>
      </div>

      <!-- More Personal Details Button -->
      <div class="more-details" id="moreDetailsContainer">
        <button
          class="more-details-button"
          id="moreDetailsButton"
          onclick="toggleDropdown()"
        >
          More Personal Details
          <img
            src="../img-source/icon_dropdown.png"
            alt="Dropdown Icon"
            class="dropdown-icon"
          />
        </button>
        <div class="dropdown-menu" id="dropdownMenu">
          <button
            class="dropdown-item"
            onclick="window.location.href='personalDetails.php?id=<?php echo $_SESSION['id']; ?>'"
          >
            Personal Details
            <img src="../img-source/icon_arrow_right.png" class="arrow-icon" />
          </button>
          <button
            class="dropdown-item"
            onclick="window.location.href='userDetails.php?id=<?php echo $_SESSION['id']; ?>';"
          >
            User Details
            <img src="../img-source/icon_arrow_right.png" class="arrow-icon" />
          </button>
          <button
            class="dropdown-item"
            onclick="window.location.href='addresses.php?id=<?php echo $_SESSION['id']; ?>'"
          >
            Addresses
            <img src="../img-source/icon_arrow_right.png" class="arrow-icon" />
          </button>
          <button
            class="dropdown-item"
            onclick="window.location.href='recommendation.php?id=<?php echo $_SESSION['id']; ?>';"
          >
            Recommendation
            <img src="../img-source/icon_arrow_right.png" class="arrow-icon" />
          </button>
        </div>
      </div>
    </main>

    <!-- Footer Section -->
    <footer class="footer-section">
      <div class="footer-container">
        <div class="footer-brand">
          <!-- Logo Section -->
          <div class="footer-logo">
            <img src="../img-source/Logo_Icon.png" alt="Baju Bekas Logo" />
          </div>
          <!-- Social Media Icons -->
          <div class="social-icons">
            <img src="../img-source/instagram_icon.png" alt="Instagram Icon" />
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

    <script src="mainProfile.js"></script>
  </body>
</html>
