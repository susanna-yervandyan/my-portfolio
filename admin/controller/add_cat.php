<?php

session_start();
include_once("../model/model.php");

$action = $_POST['action'] ?? '';

if ($action === "add") {
    $name = $_POST['name'];
    $image = $_FILES['cat_img']['name'];

    if (empty($name) || empty($image)) {
        echo "error";
    } else {
        // Move uploaded image to the specified directory
        if (move_uploaded_file($_FILES['cat_img']['tmp_name'], "../assets/image/$image")) {
            $model->add_category($name, $image);
            echo "Category added successfully";
        } else {
            echo "Failed to upload image";
        }
    }
}

if ($action === "update") {
    $name = $_POST['text'] ?? '';
    $id = $_POST['id'] ?? '';

    if (!empty($name) && !empty($id)) {
        $result = $model->update($name, $id);
        if ($result) {
            echo "Category updated successfully";
        } else {
            echo "Failed to update category";
        }
    } else {
        echo "Missing category name or ID";
    }
}

if ($action === "delete") {
    $id = $_POST['id'] ?? '';
    if (!empty($id)) {
        $model->delete($id);
        echo "Category deleted successfully";
    } else {
        echo "Missing category ID";
    }
}

?>
