<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['id']) || !isset($_SESSION['type'])) {
    header("Location: ../account-section/login.php");
    exit;
}
require '../dbconnections.php';

// Fetch orders for the logged-in user
$userId = $_SESSION['id'];
$query = "SELECT * FROM orders WHERE orderby = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="maincart.css" />
    <title>Baju Bekas - CartSection</title>
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
            <div id="overlay" class="overlay hidden" onclick="toggleMenu()"></div>
        </div>
    </nav>
</header>
<main>
    <section class="cart-section">
        <div class="cart-items">
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <div class="cart-item">
                        <input
                            type="checkbox"
                            class="select-item"
                            data-name="<?php echo htmlspecialchars($order['title']); ?>"
                            data-price="<?php echo htmlspecialchars($order['price']); ?>"
                            data-basePrice="<?php echo htmlspecialchars($order['price']); ?>"
                            checked
                        />
                        <img src="../uploads/<?php echo htmlspecialchars($order['image']); ?>" alt="catalog picture" />
                        <div class="item-details">
                            <h3><?php echo htmlspecialchars($order['title']); ?></h3>
                            <p class="price">Rp <?php echo htmlspecialchars($order['price']); ?></p>
                            <div class="item-options">
                                <div class="color">
                                    <label>Color:</label>
                                    <span><?php echo htmlspecialchars($order['color']); ?></span>
                                </div>
                                <div class="size">
                                    <label>Size:</label>
                                    <span><?php echo htmlspecialchars($order['size']); ?></span>
                                </div>
                                <div class="quantity">
                                    <label>Quantity:</label>
                                    <button>-</button>
                                    <span>1</span>
                                    <button>+</button>
                                </div>
                            </div>
                        </div>
                        <button 
                            class="remove-item" 
                            onclick="if(confirm('Are you sure you want to delete this item?')) { window.location.href = 'remove_order.php?id=<?php echo htmlspecialchars($order['id']); ?>'; }">
                            X
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No items in your cart.</p>
            <?php endif; ?>
        </div>
        <div class="order-summary">
            <h3>Order Summary</h3>
            <ul id="summary-list"></ul>
            <div class="divider"></div>
            <div class="total">
                <p>
                    <strong>SALES TAX</strong>
                    <span>(11% VAT based on Indonesian regulation)</span>
                </p>
                <p><strong>SHIPPING</strong> <span>Free</span></p>
                <div class="divider"></div>
                <p>
                    <strong>TOTAL <span id="total-price">Rp0</span></strong>
                </p>
            </div>
            <form action="../paymentMethod-section/mainPayment.php" method="POST">
                <?php
                $query = "SELECT o.*, c.sellerid 
                          FROM orders o 
                          LEFT JOIN catalog c ON o.title = c.title AND o.price = c.price 
                          WHERE o.orderby = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                $orders = $result->fetch_all(MYSQLI_ASSOC);
                $stmt->close();

                foreach ($orders as $order):
                    $title = htmlspecialchars($order['title']);
                    $price = htmlspecialchars($order['price']);
                    $sellerId = htmlspecialchars($order['sellerid']);
                ?>
                    <input type="hidden" name="item_title[]" value="<?php echo $title; ?>">
                    <input type="hidden" name="item_price[]" value="<?php echo $price; ?>">
                    <input type="hidden" name="item_sellerid[]" value="<?php echo $sellerId; ?>">
                <?php endforeach; ?>
                <button type="submit" class="checkout-btn">PROCEED TO CHECKOUT</button>
            </form>
        </div>
    </section>
</main>
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
<script src="maincart.js"></script>
</body>
</html>
