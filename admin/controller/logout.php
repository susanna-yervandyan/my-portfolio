<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header('Location: ../view/login.php'); // Adjust the path if needed
exit(); // Ensure no further code is executed after the redirect

