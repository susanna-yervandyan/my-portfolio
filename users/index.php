<?php

include_once( 'view/header.php' );
include_once( 'model/user_model.php' ); 

$categories = $user_model->get_categories(); // Get categories
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Categories</title>
	<link rel="stylesheet" href="assets/css/style.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
	<h2>CATEGORIES</h2>
	<div class="category-grid">
    <?php if (!empty($categories)) : ?>
        <?php foreach ($categories as $category) : ?>
            <div class="category-card">
                <h3><?= htmlspecialchars($category['name']) ?></h3>
                <img src="../admin/assets/image/<?= htmlspecialchars($category['image']) ?>" width="100" height="100" alt="<?= htmlspecialchars($category['name']) ?>">
                <a href="view/products.php?cat_id=<?= $category['id'] ?>">View Products</a>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No categories found.</p>
    <?php endif; ?>
</div>


</body>
</html>