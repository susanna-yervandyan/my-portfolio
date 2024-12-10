<?php
session_start();
include_once("../model/model.php");
include_once('header.php');

if (!isset($_SESSION['admin'])) {
    header("location:login.php");
    die();
}

echo "Welcome home " . $_SESSION['admin'] . "<br>";

$all = $model->get_categories();
$orders = $model->getAllOrders(); // Fetch all orders from the model

?>

<!-- Back button to go to home -->
<a href="../view/home.php" class="back-button">Back to Home</a>
<a href="../view/orders.php">Orders</a>
<a href="../controller/logout.php">Log Out</a>



<!-- Orders Table -->
<h2>Recent Orders</h2>

<table>
    <caption>Orders</caption>
    <tr>
        <th>Order ID</th>
        <th>User ID</th>
        <th>Product ID</th>
        <th>Quantity</th>
        <th>Created Date</th>
    </tr>
    <?php if (count($orders) > 0): ?>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['id']) ?></td>
                <td><?= htmlspecialchars($order['user_id']) ?></td>
                <td><?= htmlspecialchars($order['prod_id']) ?></td>
                <td><?= htmlspecialchars($order['quantity']) ?></td>
                <td><?= htmlspecialchars($order['created_date']) ?></td>
                <!-- Removed total_price to avoid error -->
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No orders found.</td>
        </tr>
    <?php endif; ?>
</table>


<?php
include_once('footer.php');
?>
