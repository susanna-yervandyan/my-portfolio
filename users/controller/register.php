<?php

session_start();
include_once("../model/user_model.php");

$action = isset($_POST['btn_reg']) ? $_POST['btn_reg'] : "";
if ($action != "") {
    if ($action === "btn") {
        $name = $_POST['name'];
        $login = $_POST['login'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $conf_pass = $_POST['conf_pass'];
        if (empty($name) || empty($login) || empty($email) || empty($pass) || empty($conf_pass)) {
            $_SESSION['error'] = "Please fill all fields";
            header('Location: ../view/reg_form.php');
            exit;
        }else{
            if($pass != $conf_pass){
                $_SESSION['error'] = "Password don't match";
                header('Location: ../view/reg_form.php');
                exit; 
            }else{
                $reg_check = $user_model->check_user($email);
                if($reg_check > 0){
                    $_SESSION['error'] = "Email already exists";
                    header('Location: ../view/reg_form.php');
                    exit;
                }else{
                    $add_user = $user_model->add_user($name,$login,$pass,$email);
                    if($add_user){
                        $_SESSION['message'] = "Registration complete succesfully";
                    header('Location: ../view/reg_form.php');
                    exit;
                    }else{
                        $_SESSION['error'] = "File to register user";
                    header('Location: ../view/reg_form.php');
                    }
                }
            }
        }
    }
}
