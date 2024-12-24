<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
    header("Location: account-section/login.php");
    exit;
}

require '../dbconnections.php';

$userId = $_SESSION['id'];

// SQL query to fetch order history for the logged-in user from the orderhistory table
$query = "SELECT oh.title, oh.price, oh.selledby
          FROM orderhistory oh 
          WHERE oh.buyby = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId); // Bind the logged-in user's ID
$stmt->execute();
$result = $stmt->get_result();

// Fetch all results
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="orderHistory.css" />
    <title>Baju Bekas - Order History</title>
</head>
<body>
    <!-- header section -->
    <header>
        <nav class="navbar">
            <div class="navbar-container">
                <div class="shop-icon">
                    <a href="../index.php"><img src="../img-source/shop_icon.png" alt="Shop Icon" /></a>
                </div>
                <div class="logo">
                    <a href="../index.php"><img src="../img-source/Logo_Icon.png" alt="Baju Bekas Logo" /></a>
                </div>
                <div class="nav-icons">
                    <div class="search-icon">
                        <a href="../search/search.php"><img src="../img-source/icon_search.png" alt="Search Icon" /></a>
                    </div>
                    <div class="profile-icon">
                        <a href="mainProfile.php"><img src="../img-source/icon_profile.png" alt="Profile Icon" /></a>
                    </div>
                    <div class="menu-icon" onclick="toggleMenu()">
                        <img src="../img-source/icon_menu.png" alt="Menu Icon" />
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
            <img src="../img-source/WhatsApp Image 2024-11-22 at 04.26.10.jpeg" alt="User Background" />
        </div>
        <h1 class="user-name">WELCOME <?php echo $_SESSION['email']; ?></h1>
    </div>

    <!-- main section -->
    <main>
        <section class="orderHistory-section">
            <aside class="sidebar">
                <ul class="sidebar-menu">
                    <li><a href="wishlistProfile.php?id=<?php echo $_SESSION['id']; ?>">Wishlist</a></li>
                    <li><a href="orderHistory.php?id=<?php echo $_SESSION['id']; ?>">Order History</a></li>
                    <li><a href="personalDetails.php?id=<?php echo $_SESSION['id']; ?>">Personal Details</a></li>
                    <li><a href="userDetails.php?id=<?php echo $_SESSION['id']; ?>">User Details</a></li>
                    <li><a href="addresses.php?id=<?php echo $_SESSION['id']; ?>">Addresses</a></li>
                    <li><a href="recommendation.php">Recommendation</a></li>
                </ul>
            </aside>

            <div class="main-content">
                <div class="title-section">
                    <h2 class="section-title">ORDER HISTORY</h2>
                    <p class="section-subtitle">MR. <?php echo $_SESSION['email']; ?>, HERE YOU WILL FIND YOUR PRODUCT HISTORY FROM YOUR CHECKOUT</p>
                </div>
                <div class="order-history-content">
                    <!-- Filters for date and order status -->
                    <div class="filters">
                        <select class="filter" name="filter-days" onchange="filterOrders()">
                            <option value="">FILTER DAYS</option>
                            <option value="7">Last 7 Days</option>
                            <option value="30">Last 30 Days</option>
                            <option value="365">Last Year</option>
                        </select>
                        <select class="filter" name="filter-orders" onchange="filterOrders()">
                            <option value="">FILTER ORDERS</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <!-- Order History -->
                    <div class="history-status">
                        <?php if (count($orders) > 0) { ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>selled by</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($order['title']); ?></td>
                                            <td><?php echo htmlspecialchars($order['price']); ?></td>

                                            <td><?php echo htmlspecialchars($order['selledby']); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <p>Your order history is empty.</p>
                        <?php } ?>
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
                <div class="footer-logo">
                    <img src="../img-source/Logo_Icon.png" alt="Baju Bekas Logo" />
                </div>
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
    <script src="orderHistory.js"></script>
</body>
</html>
