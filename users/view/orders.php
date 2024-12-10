<?php

include('header.php');
include "../Model/user_model.php"; // Include your model

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php"); // Redirect to login if not logged in
    exit;
}

// Get user_id from session
$user_id = $_SESSION['user_id'];

// Retrieve orders for the user
$orders = $user_model->get_orders_by_user($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="../assets/css/style.css"> 
</head>
<body>


    <h2>My Orders</h2>
   <!-- Back button to go to categories -->
<a href="../index.php" class="back-button">Back to Categories</a> 
    <?php if (count($orders) > 0): ?>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Created Date</th>
            </tr>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['prod_id']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo $order['created_date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>You have no orders yet.</p>
    <?php endif; ?>

</body>
</html>
