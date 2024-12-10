<?php 
session_start();
include_once("../Model/model.php");

if(!isset($_POST['btn_enter'])){
    header("location:../view/login.php");
    die;
}

if(empty($_POST['login']) || empty(($_POST['password']))){
    $_SESSION['error'] = "<b>Empty login or password</b>";
    header("location:../view/login.php");
    die;
}
$login = $_POST['login'];
$pass = $_POST['password'];
$count = $model->admin($login,$pass);
if($count>0){
    $_SESSION['admin'] = $login;
    header("location:../view/home.php");
    die;
}else{
    $_SESSION['error'] = "<b>Wrong login or password</b>";
    header("location:../view/login.php");
    die;
}


?>