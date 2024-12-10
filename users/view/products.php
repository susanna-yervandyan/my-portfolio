<?php

include_once('header.php');
include_once('../model/user_model.php');

// Initialize $category_name and $products
$category_name = 'Category Not Found'; // Default value if no category is found
$products = []; // Initialize an empty array for products

if (isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
    
    // Fetch products based on the selected category
    $products = $user_model->get_products($cat_id);
    
    // Fetch the category name based on cat_id
    $category = $user_model->get_category_by_id($cat_id); // Create this method in your model if it doesn't exist
    if ($category) {
        $category_name = $category['name']; // Assuming 'name' is the column for category names
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css"> 
    <script src = "../assets/js/jquery-3.7.1.js"></script>
    <script src = "../assets/js/cart.js"></script>
    <title>PRODUCTS</title>
</head>
<body>

<h2>PRODUCTS IN <?= htmlspecialchars($category_name) ?></h2>

<!-- Back button to go to categories -->
<a href="../index.php" class="back-button">Back to Categories</a>

<div class="product-grid">
    <?php if (!empty($products)) : ?>
        <?php foreach ($products as $product) : ?>
            <div class="product-card">
                <img src="../../admin/assets/image/<?= htmlspecialchars($product['image']) ?>" alt="Product Image" class="product-image">
                <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>
                <p class="product-description"><?= htmlspecialchars($product['description']) ?></p>
                <p class="product-price">Price: <?= htmlspecialchars($product['price']) ?> <?= htmlspecialchars($product['currency'] ?? 'AMD') ?></p>
                <button class="btn_add" data-id="<?= htmlspecialchars($product['id']) ?>">Add to cart</button>

            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No products found for this category.</p>
    <?php endif; ?>
</div>

</body>
</html>
