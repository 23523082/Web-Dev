<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['id']) || !isset($_SESSION['type'])) {
    header("Location: account-section/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BajuBekas</title>
    <link rel="stylesheet" href="searchPage.css">
</head>
<body>

<header>
    <div href="../index.php">BAJU BEKAS</div>
    <nav>
        <a href="../index.php">Home</a>
        <a href="../index.php">Products</a>
        <a href="../aboutUs/aboutUs.html">About</a>
    </nav>
    <div class="icons">
        <a href="../profile section/mainProfile.php">&#128100;</a>
        <a href="#">&#128722;</a>
    </div>
</header>

<div class="search-container">
    <div class="animated-text">
        <h2>Looking for something unique?</h2>
        <p>Discover fashion that fits your style. Start your search now!</p>
    </div>
    <div class="search-wrapper">
        <form method="GET" action="searchResult.php">
            <input type="text" id="searchInput" name="query" placeholder="Search for products...">
            <button type="submit">🔍</button>
            <div class="category-dropdown" id="categoryDropdown">
                <a href="../menuMan/menuMan.php">Men's Fashion</a>
                <a href="../menuWomen/menuWomen.php">Women's Fashion</a>
                <a href="../menuChild/menuChild.php">Children's Fashion</a>
                <a href="../menuBag/handBags.php">Handbags</a>
            </div>
        </form>
    </div>
</div>

<footer>
    <div>
        <h3>BAJU BEKAS</h3>
        <p>Our Main Products</p>
        <a href="../menuMan/menuMan.php">Men Fashion</a>
        <a href="../menuWomen/menuWomen.php">Women Fashion</a>
        <a href="../menuChild/menuChild.php">Children Fashion</a>
        <a href="../menuBag/handBags.php">Handbags Fashion</a>
    </div>
    <div>
        <h3>Services</h3>
        <a href="../menuMan/menuMan.php">Selling Fashion for Men</a>
        <a href="../menuWomen/menuWomen.php">Selling Fashion for Women</a>
        <a href="../menuChild/menuChild.php">Selling Fashion for Children</a>
        <a href="../menuBag/handBags.php">Selling Handbags</a>
    </div>
    <div>
        <h3>Contact Information</h3>
        <p>Kaliurang St No.Km. 14,5, Krawitan, Umbulmartani,<br> Ngemplak, Sleman Regency, Special Region of Yogyakarta 55584</p>
        <a href="#">&#x1F426; Twitter</a>
        <a href="#">&#x1F4F7; Instagram</a>
        <a href="#">&#x1F466; Facebook</a>
    </div>
</footer>

<script>
    function showDropdown() {
        document.getElementById('categoryDropdown').style.display = 'block';
    }

    // Hide dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('categoryDropdown');
        const searchInput = document.getElementById('searchInput');
        
        if (!searchInput.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });
</script>

</body>
</html>
