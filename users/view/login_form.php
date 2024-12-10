<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../assets/css/style.css"> 
</head>
<body>
    <br>
    <h2>LOGIN FORM</h2>
    <form action="../controller/login.php" method="post">
        <input type="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        <input type="password" name="pass" placeholder="Password">
        <input type="checkbox" name="inp_check"> Remember Me
        <button name="btn_login" value="btn">Login</button>
        <a href="reg_form.php" class="button">Go to Registration</a>
        
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
