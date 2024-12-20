<?php 
session_start();
require '../dbconnections.php';

// Check if user is logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
    die("Error: User is not logged in.");
}

// Fetch user's first name and last name
$userQuery = $conn->prepare("SELECT FirstName, LastName FROM users WHERE id = ?");
$userQuery->bind_param("i", $_SESSION['id']);
$userQuery->execute();
$userResult = $userQuery->get_result()->fetch_assoc();
$userQuery->close();

// Fetch user's address details
$addressQuery = $conn->prepare("SELECT country, address, post_code, city FROM addresses WHERE user_id = ?");
$addressQuery->bind_param("i", $_SESSION['id']);
$addressQuery->execute();
$addressResult = $addressQuery->get_result()->fetch_assoc();
$addressQuery->close();

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="addresses.css" />
    <title>Baju Bekas - Addresses</title>
  </head>
  <body>
    <!-- header section -->
    <header>
      <nav class="navbar">
        <div class="navbar-container">
          <div class="shop-icon">
            <a href="#"><img src="img_profile/shop_icon.png" alt="Shop Icon" /></a>
          </div>
          <div class="logo">
            <a href="../index.php"><img src="img_profile/Logo_Icon.png" alt="Baju Bekas Logo" /></a>
          </div>
          <div class="nav-icons">
            <div class="search-icon">
              <a href="#"><img src="img_profile/icon_search.png" alt="Search Icon" /></a>
            </div>
            <div class="profile-icon">
              <a href="mainProfile.html"><img src="img_profile/icon_profile.png" alt="Profile Icon" /></a>
            </div>
            <div class="menu-icon" onclick="toggleMenu()">
              <img src="img_profile/icon_menu.png" alt="Menu Icon" />
            </div>
          </div>
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
    <div class="user-header">
      <div class="user-background">
        <div class="overlay"></div>
        <img src="img_profile/WhatsApp Image 2024-11-22 at 04.26.10.jpeg" alt="User Background" />
      </div>
      <h1 class="user-name">WELCOME <?php echo htmlspecialchars($userResult['FirstName'] . ' ' . $userResult['LastName']); ?></h1>
    </div>
    <!-- main section -->
    <main>
      <section class="Addresses-section">
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
        <div class="main-content">
          <div class="title-section">
            <h2 class="section-title">ADDRESSES</h2>
            <p class="section-subtitle">
              <?php echo htmlspecialchars($userResult['FirstName'] . ' ' . $userResult['LastName']); ?>, HERE YOU WILL ADD YOUR ADDRESS IN YOUR ACCOUNT
            </p>
          </div>
          <div class="Addresses-contents">
            <form method="post" action="adressSave.php">
              <div class="form-title">
                <label for="title">TITLE :</label>
                <div class="title-container">
                  <select id="title-dropdown" name="title">
                    <option value="Mr." selected>Mr.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Ms.">Ms.</option>
                  </select>
                  <span id="readonly-name" class="readonly-name">
                    <?php echo htmlspecialchars($userResult['FirstName'] . ' ' . $userResult['LastName']); ?>
                  </span>
                </div>
              </div>
              <!-- Country -->
              <div class="form-country">
                <label for="country">COUNTRY :</label>
                <select id="country" name="country">
                  <option value="">Select a country</option>
                  <option value="Indonesia" <?php echo ($addressResult['country'] === "Indonesia") ? "selected" : ""; ?>>Indonesia</option>
                  <option value="Malaysia" <?php echo ($addressResult['country'] === "Malaysia") ? "selected" : ""; ?>>Malaysia</option>
                  <option value="Singapore" <?php echo ($addressResult['country'] === "Singapore") ? "selected" : ""; ?>>Singapore</option>
                  <!-- Add other countries as needed -->
                </select>
              </div>
              <!-- Address -->
              <div class="form-address">
                <label for="address">ADDRESS :</label>
                <textarea id="address" name="address" rows="4" cols="50"><?php echo htmlspecialchars($addressResult['address']); ?></textarea>
              </div>
              <!-- Post code and city -->
              <div class="form-row">
                <div class="form-name">
                  <label for="post-code">POST CODE :</label>
                  <input type="text" id="post-code" name="post-code" value="<?php echo htmlspecialchars($addressResult['post_code']); ?>" />
                </div>
                <div class="form-name">
                  <label for="city">CITY :</label>
                  <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($addressResult['city']); ?>" />
                </div>
              </div>
              <button type="submit" class="save-button">SAVE</button>
            </form>
          </div>
        </div>
      </section>
    </main>
    <!-- Footer Section -->
    <footer class="footer-section">
      <div class="footer-container">
        <div class="footer-brand">
          <div class="footer-logo">
            <img src="img_profile/Logo_Icon.png" alt="Baju Bekas Logo" />
          </div>
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
  </body>
</html>
