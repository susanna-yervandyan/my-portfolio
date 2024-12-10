<?php

session_start();
include_once("../model/model.php");


$action = $_POST['action'];
if($action === "add"){
    $cat_id = $_SESSION['cat_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $img = $_FILES['img']['name'];
    $currency = $_POST['currency']; 


    if(empty($cat_id) || empty($name) || empty($price) ||empty($currency)){
        $_SESSION['error'] = "Input fields";
    header('location:../view/products.php');
    die;
   }
   move_uploaded_file($_FILES['img']['tmp_name'], "../assets/image/$img");
   $model->add_products($cat_id,$name,$price, $desc,$img, $currency,);
   header("location:../view/products.php");
}

// Update product functionality
if(isset($action) && $action === "update_prod"){
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $currency = $_POST['currency'];
    $id = $_POST['id'];
    $update_product=$model->update_product($name,$desc,$price,$currency,$id);
    if($update_product){
        echo "Product update successfully";
    }else{
    echo "Product dosn't update";
    }
}

// Delete product functionality
if(isset($action) && $action === "delete_prod"){
    $id = $_POST['id'];
    
    $delete_product = $model->delete_product($id);
    if($delete_product){
        echo "Product deleted successfully";
    } else {
        echo "Failed to delete product";
    }
}










