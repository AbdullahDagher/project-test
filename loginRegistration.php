<?php
session_start();
include 'connection.php';
include 'functions.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['csrf_token']) && $_POST['csrf_token'] == $_SESSION['CSRF_token_login']){
        unset($_SESSION['errors']);
        unset($_SESSION['data']);

        $username = htmlspecialchars(trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING)));
        $password = htmlspecialchars(trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING)));
        $error_msg = [];

        if(empty($username)){
            $error_msg[] = 'Please Enter username';
        } else{
            $stmt = $con->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->execute(array(encryptData($username)));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $userCount = $stmt->rowCount();
            if($userCount == 1 ){
                $hashedPasswordCheck = password_verify($password, $row['password']);
                if($hashedPasswordCheck){
                    $_SESSION['username'] = decryptData($row['username']);
                    header('Location: inbox.php');
                    exit();
                }else
                    $error_msg[] = 'Username Or Password Not Matched';
            }else
                $error_msg[] = 'Username Or Password Not Matched';
        }
        $data = [
            'username' => $username
        ];

        $_SESSION['errors'] = $error_msg;
        $_SESSION['data'] = $data;
        header('Location: login.php');
        exit();

    }else{
        header('Location: login.php');
        exit();
    }


}else{
    header('Location: login.php');
    exit();
}