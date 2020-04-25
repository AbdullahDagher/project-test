<?php
session_start();
include 'connection.php';
include 'functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['csrf_token']) && $_POST['csrf_token'] == $_SESSION['CSRF_token_resetPass']){
        unset($_SESSION['errors']);
        unset($_SESSION['data']);

        $password = htmlspecialchars(trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING)));
        $confirmPassword = htmlspecialchars(trim(filter_var($_POST['confirm-password'], FILTER_SANITIZE_STRING)));


        $error_msg = [];

        if((strlen($password) < 8)){
            $error_msg[] = 'password must be more than 8 char';
        }elseif(!preg_match('/[0-9]/', $password)){
            $error_msg[] = 'password must at least has one number';
        }elseif(!preg_match('/[a-z]/', $password)){
            $error_msg[] = 'password must at least has one lowercase';
        }elseif(!preg_match('/[A-Z]/', $password)){
            $error_msg[] = 'password must at least has one uppercase';
        }elseif(!preg_match('/[!@+_*%]/', $password)){
            $error_msg[] = 'password must least has one of these symbols !, @, +, _, *, %';
        }

        if($password!==$confirmPassword){
            $error_msg[] = 'password not match';
        }

        if(empty($error_msg)){

            $stmt = $con->prepare('UPDATE `users` SET `password` = ? WHERE `username` = ? ');
            $stmt->execute(array(password_hash($password, PASSWORD_DEFAULT), encryptData($_SESSION['resetUser'])));
            unset($_SESSION['resetUser']);
            unset($_SESSION['resetStatus']);
            header('Location: login.php');
            exit();
        }else{
            $_SESSION['errors'] = $error_msg;
            header('Location: reset-password.php');
            exit();
        }

    }else{
        header('Location: reset-password.php');
        exit();
    }

}else{
    header('Location: reset-password.php');
    exit();
}

