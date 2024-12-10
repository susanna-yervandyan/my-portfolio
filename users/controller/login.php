<?php

session_start();
include_once("../model/user_model.php");

if(empty($_POST['btn_login']))die;
$email=$_POST['email'];
$pass=$_POST['pass'];
if(empty($email) || empty($pass)){
    $_SESSION['error']="Empty field";
    header('location:../view/login_form.php');
    exit;
}
 $user=$user_model->check_login($email,$pass);
if(!$user){
    $_SESSION['error']="Wrong email or password";
    header('location:../view/login_form.php');
    die;
}else{
    if(isset($_POST['inp_check'])){
        setcookie('user_id',$user['id'],time()+(86400*30),"/");
        setcookie('user_email',$user['email'],time()+(86400*30),"/");
    }
    $_SESSION['user_id']=$user['id'];
    $_SESSION['user_email']=$user['email'];
    header('location:../index.php');
}












