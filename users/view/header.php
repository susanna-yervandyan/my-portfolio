<?php
session_start();

function createUrl($path) {
    $baseUrl = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/shop_for_close/users/view/";
    return $baseUrl . $path;
}

$items = array(
    "Home" => array("url" => "http://localhost/shop_for_close/users/index.php", "icon" => "fas fa-home"),
    "Cart" => array("url" => createUrl("cart.php"), "icon" => "fas fa-shopping-cart"),
    "Orders" => array("url" => createUrl("orders.php"), "icon" => "fas fa-box"),
);

if (isset($_SESSION['user_email'])) {
    $items['Log out'] = array("url" => "http://localhost/shop_for_close/users/controller/log_out.php", "icon" => "fas fa-sign-out-alt");
    $items[$_SESSION['user_email']] = array("url" => "#", "icon" => "fas fa-user");
} else {
    $items['Login'] = array("url" => createUrl('login_form.php'), "icon" => "fas fa-sign-in-alt");
    $items['Registration'] = array("url" => createUrl('reg_form.php'), "icon" => "fas fa-user-plus");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../assets/js/jquery-3.7.1.js"></script>

    <title>Your Website Title</title>
</head>
<body>
<header>
    <div class="header-content">
    <div class="logo-container">
    <a href="../index.php">
        <img src="../assets/image/my_logo.png" alt="Logo" class="logo">
    </a>
</div>
        <h2 class="welcome-message">CAR SHOP</h2>
        <nav>
            <ul class="header-buttons">
                <?php
                foreach ($items as $label => $item) {
                    echo "<li><a href='{$item['url']}' class='button'><i class='{$item['icon']}'></i> " . htmlspecialchars($label) . '</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</header>
