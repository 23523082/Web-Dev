<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['id']) || !isset($_SESSION['type'])) {
    header("Location: ../account-section/login.php");
    exit;
}

// Retrieve cart data passed from the previous page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $items = $_POST['item_title'];
    $prices = $_POST['item_price'];
    $sellerIds = $_POST['item_sellerid'];

    $_SESSION['checkout_items'] = [
        'titles' => (array)$items,
        'prices' => (array)$prices,
        'sellerIds' => (array)$sellerIds,
    ];
} elseif (!isset($_SESSION['checkout_items'])) {
    header("Location: maincart.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="mainPayment.css" />
    <title>Baju Bekas - Payment</title>
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
        </div>
    </nav>
</header>

<main>
    <section class="payment-methods">
        <h1>Choose Payment Methods</h1>
        <div class="content-cards">
            <div class="content-card" id="credit-card" onclick="openCardPayment()">
                <img src="img_profile/iconkartu-kredit.png" alt="Credit Card" />
                <p>Add a credit or debit card</p>
            </div>
            <div class="content-card" id="qris" onclick="openQrisPayment()">
                <img src="img_profile/Icon-Qris.png" alt="QRIS" />
                <p>QRIS</p>
            </div>
        </div>
    </section>

    <!-- Card Payment Popup -->
    <div id="popup-card" class="popup hidden">
        <div class="popup-content">
            <button class="close-popup" onclick="closePopup('popup-card')">&times;</button>
            <h2>New Card</h2>
            <form action="finalizingPayment.php" method="POST">
                <div class="form-section">
                    <div class="form-group">
                        <label for="card-number">Credit Card Number</label>
                        <input type="text" id="card-number" name="card_number" placeholder="xxxx - xxxx - xxxx - xxxx" required />
                    </div>
                    <div class="form-group">
                        <label for="security-code">Security Code</label>
                        <input type="text" id="security-code" name="security_code" placeholder="3 - 4 Digits" required />
                    </div>
                    <div class="form-group expiration-group">
                        <label for="expiration-date">Expiration Date</label>
                        <div class="expiration">
                            <select id="month" name="expiration_month" required>
                                <option value="" disabled selected>MM</option>
                                <?php for ($m = 1; $m <= 12; $m++): ?>
                                    <option value="<?= str_pad($m, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($m, 2, '0', STR_PAD_LEFT) ?></option>
                                <?php endfor; ?>
                            </select>
                            <select id="year" name="expiration_year" required>
                                <option value="" disabled selected>YYYY</option>
                                <?php for ($y = date('Y'); $y <= date('Y') + 10; $y++): ?>
                                    <option value="<?= $y ?>"><?= $y ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="name-on-card-section">
                    <label for="name-on-card">Name on Card</label>
                    <input type="text" id="name-on-card" name="name_on_card" placeholder="Name on Card" required />
                </div>
                <button type="submit" name="payment_method" value="card" class="save-button">Pay Now</button>
            </form>
        </div>
    </div>

    <!-- QRIS Payment Popup -->
    <div id="popup-qris" class="popup hidden">
        <div class="popup-content">
            <button class="close-popup" onclick="closePopup('popup-qris')">&times;</button>
            <h2>QRIS Method</h2>
            <div class="contentQris">
                <img src="img_profile/Icon-Qris.png" alt="QRIS Logo" />
                <p>Scan the QR code to pay. Please do not close this page.</p>
                <img src="path/to/generated-qr-code.png" alt="QR Code" class="qris" />
                
                <!-- Form to trigger POST request -->
                <form action="finalizingPayment.php" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                    <?php
                    if (isset($_SESSION['checkout_items'])):
                        foreach ($_SESSION['checkout_items']['titles'] as $index => $title):
                    ?>
                        <input type="hidden" name="item_title[]" value="<?= htmlspecialchars($title) ?>">
                        <input type="hidden" name="item_price[]" value="<?= htmlspecialchars($_SESSION['checkout_items']['prices'][$index]) ?>">
                        <input type="hidden" name="item_sellerid[]" value="<?= htmlspecialchars($_SESSION['checkout_items']['sellerIds'][$index]) ?>">
                    <?php endforeach; endif; ?>
                    <button type="submit" class="pay-now">Confirm Payment</button>
                </form>
            </div>
        </div>
    </div>
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
        <p>Copyright © 2022 | All Rights Reserved.</p>
        <p>Created with love by Five_Mushketeer</p>
    </div>
</footer>

<script src="mainPayment.js"></script>
<script>
    function openCardPayment() {
        document.getElementById('popup-card').classList.remove('hidden');
    }

    function openQrisPayment() {
        document.getElementById('popup-qris').classList.remove('hidden');
    }

    function closePopup(popupId) {
        document.getElementById(popupId).classList.add('hidden');
    }

    function confirmPayment() {
        // You can add further confirmation logic here, such as displaying a success message.
    }
</script>
</body>
</html>
