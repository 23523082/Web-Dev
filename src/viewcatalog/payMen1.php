<?php
session_start();
require 'viewcatalogscript.php';

if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
  header("Location: account-section/login.php");
  exit;
}
if (!isset($_GET['id']) || empty($_GET['id'])) {
  die("Product ID not specified.");
} else {
  echo "Product ID: " . htmlspecialchars($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($product['title']); ?></title>
    <link rel="stylesheet" href="menuMan.css" />
  </head>
  <body>
    <!-- Navbar -->
    <header>
      <nav class="navbar fixed-navbar">
        <div class="logo">
          <a href="../index.php">BAJU BEKAS</a>
        </div>
        <ul class="nav-links">
          <li><a href="../index.php">Shop</a></li>
          <li><a href="../profile section/mainProfile.php">Profile</a></li>
          <li><a href="../search/search.php">Search</a></li>
          <li class="dropdown">
            <a href="#" class="menu-link">Menu</a>
            <ul class="dropdown-menu">
              <li><a href="../menuWomen/menuWomen.php">Women</a></li>
              <li><a href="../menuChild/menuChild.php">Children</a></li>
              <li><a href="../menuBag/handBags.php">Handbags</a></li>
              <li><a href="../menuMan/menuMan.php">Man</a></li>

            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <!-- Navbar -->

    <!-- Product Page -->
    <section class="produk-page">
      <div class="produk-container">
        <!-- Product Image -->
        <div class="card">
          <img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" />
        </div>

        <!-- Product Description -->
        <div class="produk-info">
          <h2><?php echo htmlspecialchars($product['title']); ?></h2>
          <h3>Seller : <?php echo htmlspecialchars($product['FirstName'] . ' ' . $product['LastName']); ?></h3>
          <h4>Likes : <?php echo htmlspecialchars($product['likes']); ?></h4>
          <form action="likeProduct.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <button type="submit" class="btn-like">❤️ Like this Product</button>
            </form>
          <p class="deskripsi"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>


          <ul class="detail-produk">
            <li>✔️ Bahan: <?php echo htmlspecialchars($product['material']); ?></li>
            <li>✔️ Warna: <?php echo htmlspecialchars($product['color']); ?></li>
            <li>✔️ Ukuran: <?php echo htmlspecialchars($product['size']); ?></li>
            <li>✔️ Desain: <?php echo htmlspecialchars($product['design']); ?></li>
            <li>✔️ Tipe: <?php echo htmlspecialchars($product['type']); ?></li>
          </ul>

          <!-- Purchase Button -->
          <a href="catalogAdd.php?id=<?php echo $product['id']; ?>" class="btn-purchase">Rp <?php echo $product['price']; ?> - Add</a>
          <p></p>
          <a href="wishlistAdd.php?id=<?php echo $product['id']; ?>" class="btn-purchase">Add to Wishlist</a>
        </div>
      </div>
    </section>
    <!-- Product Page -->

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
              <li><a href="menuMan.php">Men Fashion Product</a></li>
              <li><a href="menuWomen.php">Women Fashion Product</a></li>
              <li><a href="menuChild.php">Children Fashion Product</a></li>
              <li><a href="handBags.php">Handbags Fashion Product</a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3>Services</h3>
            <ul>
              <li><a href="menuMan.php">Selling Fashion for Men</a></li>
              <li><a href="menuWomen.php">Selling Fashion for Women</a></li>
              <li><a href="menuChild.php">Selling Fashion for Children</a></li>
              <li><a href="handBags.php">Selling Handbags</a></li>
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
$stmt->close();
$conn->close();
?>
