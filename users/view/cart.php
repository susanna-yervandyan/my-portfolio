<?php 
include('header.php');
include_once("../Model/user_model.php"); // Use include_once to avoid multiple inclusions

if (!isset($_COOKIE['user_id'])) {
    $_COOKIE['error'] = "Please log in first.";
    header('location:login_form.php');
    exit; // Add exit after header to stop further execution
}

$user_id = $_SESSION['user_id'];
$all = $user_model->get_cart_items($user_id);

// Check if the cart is empty
if (empty($all)) {
    echo "<p>Your cart is empty.</p>";
    exit; // Stop further execution if the cart is empty
}
?>

<p class="success" style='color:green'></p>
<p class="error" style='color:red'></p>

<link rel="stylesheet" href="../assets/css/style.css"> 
<h2>Cart</h2>

<!-- Back button to go to categories -->
<a href="../index.php" class="back-button">Back to Categories</a>

<table>
    <tr>
        <th>Name</th>
        <th>Image</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Sum</th>
        <th>Remove</th>
    </tr>
    <?php 
        $sum = 0;
        $total = 0;

        foreach($all as $value) {
            $price = $value['price'];
            $quantity = $value['quantity'];
            $sum = $price * $quantity;
            $total += $sum;
    ?>
        <tr id="<?=$value['id']?>">
            <td class="td_name"><?=$value['name']?></td>
            <td><img src="../../admin/assets/image/<?=$value['image']?>" width="100" height="100"></td>
            <td class="td_desc"><?=$value['description']?></td>
            <td class="td_price"><?=$value['price']?></td>
            <td>
                <button class="minus">-</button>
                <span class="td_quant"><?=$value['quantity']?></span>
                <button class="plus">+</button>
            </td>
            <td><p class="sum"><?=$sum?></p></td>
            <td><button class="btn_remove" data-id="<?=$value['id']?>">Remove</button></td> 
        </tr>
    <?php } 
        echo "<tr><td colspan='6'>Total</td><td class='td_total'>$total</td></tr>";
        $_SESSION['total'] = $total;
    ?>
    <tr>
        <td colspan='7' align="right">
            <button class="order" style="background-color:red">BUY</button>
        </td>
    </tr>
</table>

<script src="../Assets/js/cart.js"></script>
