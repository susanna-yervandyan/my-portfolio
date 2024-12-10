<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../assets/css/style.css"> 
</head>
<body>
<br>
<h2>Register</h2>
<form action="../controller/register.php" method="post">
    <input type="text" name="name" placeholder="Name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
    <input type="text" name="login" placeholder="Login" value="<?php echo isset($_POST['login']) ? htmlspecialchars($_POST['login']) : ''; ?>">
    <input type="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="conf_pass" placeholder="Confirm Password">
    <button name="btn_reg" value="btn">Register</button>
    <a href="login_form.php" class="button">Go to Login</a>

    <p>
        <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo '<div class="error-message">' . $_SESSION['error'] . '</div>'; // Display error message
            unset($_SESSION['error']);
        }
        ?>
    </p>
</form>

</body>
</html>
