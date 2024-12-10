<?php
	session_start();
	include_once('header.php');

?>

<form action = "../controller/login_check.php" method="post">
	<input type="text" name="login" placeholder = "Login">
	<input type="password" name="password" placeholder = "Password">
	<button name = "btn_enter">Enter</button>
	
</form>
<p style="color:red;">
	<?php
	if(isset($_SESSION['error'])){
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	 
	}
    ?>
</p>