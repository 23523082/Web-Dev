<?php 
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['id']) || $_SESSION['type'] !== 'seller') {
      header("Location: ../index.php");
       exit;
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Catalog Entry</title>
    <link rel="stylesheet" href="addcatalogstyle.css" />
</head>

<body>
    <div class="form-container">
        <h2>Add Catalog Entry</h2>

        <form action="addcatalogscript.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="sellerid" value="<?php echo $sellerid; ?>" />

            <label for="title">TITLE *</label>
            <input type="text" id="title" name="title" placeholder="Enter Product Title" required />

            <label for="image">IMAGE *</label>
            <input type="file" id="image" name="image" accept="image/*" required />

            <label for="description">DESCRIPTION *</label>
            <textarea id="description" name="description" rows="4" placeholder="Enter Product Description" required></textarea>

            <label for="material">MATERIAL *</label>
            <input type="text" id="material" name="material" placeholder="Enter Material" required />

            <label for="color">COLOR *</label>
            <input type="text" id="color" name="color" placeholder="Enter Color" required />

            <label for="size">SIZE *</label>
            <input type="text" id="size" name="size" placeholder="Enter Size" required />

            <label for="design">DESIGN *</label>
            <input type="text" id="design" name="design" placeholder="Enter Design Details" required />

            <label for="type">TYPE *</label>
            <select id="type" name="type" required>
                <option value="men">Men</option>
                <option value="women">Women</option>
                <option value="kid">Kid</option>
                <option value="bag">bag</option>
            </select>

            <button type="submit">Add to Catalog</button>
            <p><a href="../viewcatalog.php">View Catalog</a></p>
        </form>
    </div>
</body>
</html>