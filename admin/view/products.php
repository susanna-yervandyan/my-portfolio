<?php
session_start();
include_once('header.php');
include_once("../model/model.php");

if (isset($_GET['cat_id'])) {
    $_SESSION['cat_id'] = $_GET['cat_id'];
}
$all = $model->get_products($_SESSION['cat_id']);
//print_r($all);
?>

<!-- Back button to go to the categories page -->
<div class="back-button">
    <a href="home.php">Back to Home page</a> <!-- Change categories.php to your actual categories page -->
</div>

<form action="../controller/add_product.php" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="desc" placeholder="Description" required>
    
    <div>
        <input type="text" name="price" placeholder="Price" required>
        <select name="currency" required>
            <option value="AMD">AMD</option>
            <option value="$">$</option>
            <option value="€">€</option>
            <!-- Add more currency options as needed -->
        </select>
    </div>
   <br>
    <input type="file" name="img" required>
    <button name="action" value="add">Add product</button>
</form>


<p style="color:red;">
    <?php
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>
</p>

<p class="mess"></p>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Image</th>
        <th>Description</th>
        <th>Price</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <?php foreach ($all as $product) { ?>
        <tr id="<?= $product['id'] ?>">
            <td contenteditable class="td_name"><?= htmlspecialchars($product['name']) ?></td>
            <td><img src="../Assets/Image/<?= htmlspecialchars($product['image']) ?>" width="100" height="100"></td>
            <td contenteditable class="td_desc"><?= htmlspecialchars($product['description']) ?></td>
            <td>
                <input type="text" class="td_price" value="<?= htmlspecialchars($product['price']) ?>" required>
                <select class="currency_select">
                    <option value="AMD" <?= $product['currency'] === 'AMD' ? 'selected' : '' ?>>AMD</option>
                    <option value="$" <?= $product['currency'] === '$' ? 'selected' : '' ?>>$</option>
                    <option value="€" <?= $product['currency'] === '€' ? 'selected' : '' ?>>€</option>
                    <!-- Add more currency options as needed -->
                </select>
            </td>
            
            <td><button class="btn_update">Update</button></td>
            <td><button class="btn_delete">Delete</button></td>
        </tr>
    <?php } ?>
</table>

<script src="../assets/js/products.js"></script>
