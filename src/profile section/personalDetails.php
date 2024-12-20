<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['id']) || !isset($_SESSION['type'])) {
  header("Location: account-section/login.php");
  exit;
}
// Database connection
require '../dbconnections.php';

// Fetch user data based on session id
$user_id = $_SESSION['id'];

// Initialize variables
$first_name = "";
$last_name = "";
$country = "";
$dob = "";

// Fetch user's first name and last name
$userQuery = $conn->prepare("SELECT FirstName, LastName FROM users WHERE id = ?");
$userQuery->bind_param("i", $_SESSION['id']);
$userQuery->execute();
$userResult = $userQuery->get_result()->fetch_assoc();
$userQuery->close();

// Query to fetch user's first name, last name, and DOB
$user_query = "SELECT FirstName, LastName, DOB FROM users WHERE id = ?";
if ($stmt = $conn->prepare($user_query)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name, $dob);
    $stmt->fetch();
    $stmt->close();
}

// Query to fetch user's country from addresses table
$address_query = "SELECT country FROM addresses WHERE user_id = ?";
if ($stmt = $conn->prepare($address_query)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($country);
    $stmt->fetch();
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="personalDetails.css" />
    <title>Baju Bekas - Profile</title>
  </head>
  <body>
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
    <section class="personalDetails-section">
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
          <h2 class="section-title">PERSONAL DETAILS</h2>
          <p class="section-subtitle">
            <?php echo strtoupper($first_name . ' ' . $last_name); ?>, UPDATE YOUR ACCOUNT PREFERENCES BELOW.
          </p>
        </div>
        <div class="personal-details-form">
          <form action="personalDetailSave.php" method="post">
            <div class="form-group">
              <label for="title">TITLE :</label>
              <div class="title-container">
                <select id="title-dropdown" name="title">
                  <option value="Mr.">Mr.</option>
                  <option value="Mrs.">Mrs.</option>
                  <option value="Ms.">Ms.</option>
                </select>
                <span class="readonly-name"> <?php echo strtoupper($first_name . ' ' . $last_name); ?></span>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="first-name">FIRST NAME :</label>
                <input
                  type="text"
                  id="first-name"
                  name="first-name"
                  value="<?php echo htmlspecialchars($first_name); ?>"
                />
              </div>
              <div class="form-group">
                <label for="last-name">LAST NAME :</label>
                <input
                  type="text"
                  id="last-name"
                  name="last-name"
                  value="<?php echo htmlspecialchars($last_name); ?>"
                />
              </div>
            </div>
            <div class="form-group">
              <label for="country">COUNTRY :</label>
              <select id="country" name="country">
                <option value="">Select a country</option>
                <option value="Indonesia" <?php echo $country === 'Indonesia' ? 'selected' : ''; ?>>Indonesia</option>
                <option value="Malaysia" <?php echo $country === 'Malaysia' ? 'selected' : ''; ?>>Malaysia</option>
                <option value="Singapore" <?php echo $country === 'Singapore' ? 'selected' : ''; ?>>Singapore</option>
              </select>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="dob">DOB :</label>
                <input
                  type="date"
                  id="dob"
                  name="dob"
                  value="<?php echo htmlspecialchars($dob); ?>"
                />
              </div>
            </div>
            <button type="submit" class="save-button">SAVE</button>
          </form>
        </div>
      </div>
    </section>
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
      </div>
    </footer>
  </body>
</html>
