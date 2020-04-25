<?php
session_start();
include 'connection.php';
include 'functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['csrf_token']) && $_POST['csrf_token'] == $_SESSION['CSRF_token_signUp']){
        unset($_SESSION['errors']);
        unset($_SESSION['data']);

        $username = htmlspecialchars(trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING)));
        $password = htmlspecialchars(trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING)));
        $confirmPassword = htmlspecialchars(trim(filter_var($_POST['confirm-password'], FILTER_SANITIZE_STRING)));
        $answer = htmlspecialchars(trim(filter_var($_POST['answer'], FILTER_SANITIZE_STRING)));
        $QID = $_POST['QID'];


        if($QID !== "1" && $QID !== "2" && $QID !== "3" && $QID !== "4" ){
            $error_msg[] = 'Please select one of the security questions';
        }


        $error_msg = [];

        if(empty($username) || strlen($username) < 5)
            $error_msg[] = 'Name must be more than 5 char';
        else{
            $stmt = $con->prepare('SELECT username FROM users WHERE username = ?');
            $stmt->execute(array(encryptData($username)));
            $userCount = $stmt->rowCount();

            if($userCount > 0 )
                $error_msg[] = 'username exists';
        }


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

        if(empty($answer) )
            $error_msg[] = 'Please enter your answer to the security question';

        if($password!==$confirmPassword){
            $error_msg[] = 'password not match';
        }

        $data = [
            'username' => $username,
        ];

        if(empty($error_msg)){

            $stmt = $con->prepare('INSERT INTO users (`username`, `password`) VALUES (?, ?)');
            $stmt->execute(array(encryptData($username), password_hash($password, PASSWORD_DEFAULT)));
            $stmt2 = $con->prepare('INSERT INTO questionanswer (`username`, `questionID`, `answer`) VALUES (?, ?, ?)');
            $stmt2->execute(array(encryptData($username), $QID, encryptData($answer)));
            header('Location: login.php');
            exit();
        }else{
            $_SESSION['errors'] = $error_msg;
            $_SESSION['data'] = $data;
            header('Location: sign-up.php');
            exit();
        }
    }else{
        header('Location: sign-up.php');
        exit();
    }

}else{
    header('Location: sign-up.php');
    exit();
}

