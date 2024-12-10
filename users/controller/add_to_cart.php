<?php
session_start(); // Keep this as is; just ensure it doesn't throw errors
include_once "../model/user_model.php"; // Use include_once to avoid multiple inclusions

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    die;
}

$user_id = $_COOKIE['user_id']; // Ensure this is properly set in your application

// Handle add to cart action
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $id = $_POST['id'];
    $check_cart = $user_model->check_cart($user_id, $id);

    if ($check_cart) {
        $quant = $user_model->check_cart_quantity($user_id, $id);
        $newquant = ++$quant[0]['quantity']; // Increment the quantity
        $user_model->update_cart_quantity($user_id, $id, $newquant);
    } else {
        $user_model->add_to_cart($user_id, $id, 1); // Add new item with quantity 1
    }

    echo json_encode(['success' => true]);
}

// Handle update quantity action
if (isset($_POST['action']) && $_POST['action'] === "update") {
    $id = $_POST['id'];
    $plusquant = $_POST['quant'];
    $result = $user_model->update_cart($user_id, $id, $plusquant);

    // Respond with JSON to indicate success or failure
    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Quantity updated successfully.',
            'quantity' => $plusquant // Optional: Send back the updated quantity
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update quantity.'
        ]);
    }
}

// Handle remove item action
if (isset($_POST['action']) && $_POST['action'] === 'remove') {
    $id = $_POST['id'];
    // Logic to remove the product from the cart
    $result = $user_model->remove_item($user_id, $id); // Ensure this method exists in your user_model
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Item removed from cart.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Could not remove item.']);
    }
}
