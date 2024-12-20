    <?php
    session_start();
    if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
        header("Location: account-section/login.php");
        exit;
    }


    require '../dbconnections.php';


    // Query to fetch catalog data
    $sql = "SELECT id, title, image FROM catalog ORDER BY id DESC";
    $result = $conn->query($sql);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Navbar Dropdown</title>
        <link rel="stylesheet" href="newIn.css" />
    </head>
    <body>
        <!-- Navbar -->
        <header>
            <nav class="navbar fixed-navbar">
                <div class="logo">
                    <a href="../index.php">BAJU BEKAS</a>
                </div>
                <ul class="nav-links">
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Search</a></li>
                    <li class="dropdown">
                        <a href="#" class="menu-link">Menu</a>
                        <ul class="dropdown-menu">
                            <li><a href="../menuMan/menuMan.php">Men</a></li>
                            <li><a href="../menuWomen/menuWomen.php">Women</a></li>
                            <li><a href="../menuChild/menuChild.php">Children</a></li>
                            <li><a href="../menuBag/handBags.php">Handbags</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <!-- Navbar -->

        <!-- New In -->
        <section class="baju-cowok">
            <div class="cards-container">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <a href="../viewcatalog/payMen1.php?id=<?php echo $row['id']; ?>" target="_blank" class="card">
                            <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" />
                            <p><?php echo htmlspecialchars($row['title']); ?></p>
                        </a>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No catalog items found.</p>
                <?php endif; ?>
            </div>
        </section>
        <!-- New In -->

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
                            <li><a href="menuWomen.html">Selling Fashion for Women</a></li>
                            <li><a href="menuChild.css">Selling Fashion for Children</a></li>
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

    <?php
    $conn->close();
    ?>
