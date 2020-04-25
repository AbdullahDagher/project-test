<?php
session_start();
include 'connection.php';
include 'functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['csrf_token']) && $_POST['csrf_token'] == $_SESSION['CSRF_token_sendMessage']){
        unset($_SESSION['errors']);
        unset($_SESSION['data']);

        $toUser = htmlspecialchars(trim(filter_var($_POST['toUser'], FILTER_SANITIZE_STRING)));
        $content = htmlspecialchars(trim(filter_var($_POST['content'], FILTER_SANITIZE_STRING)));
        $error_msg = [];

        if(empty($toUser)){
            $error_msg[] = 'Please Enter username to send the message to';
        }elseif($toUser == $_SESSION['username']){
            $error_msg[] = 'You can\'t send a message to your self';
        } else{
            $stmt = $con->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->execute(array(encryptData($toUser)));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $userCount = $stmt->rowCount();
            if(!$userCount == 1 ){
                $error_msg[] = 'Username Not Matched';
            }
        }

        if(empty($content)){
            $error_msg[] = 'Please Enter The content Of Your Message';
        }

        $data = [
            'toUser' => $toUser,
            'content' => $content
        ];
        if(empty($error_msg)){
            $stmt = $con->prepare('INSERT INTO messages (`fromUser`, `toUser`, `content`, `readingStatus`, `date`) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([encryptData($_SESSION['username']), encryptData($toUser), encryptData($content), 0, date("Y-m-d H:i:s")]);
            $_SESSION['message'] = "Your Message sent successfully";
            header('Location: inbox.php');
            exit();
        }else{
            $_SESSION['errors'] = $error_msg;
            $_SESSION['data'] = $data;
            header('Location: send-message.php');
            exit();
        }
    }else{
        header('Location: send-message.php');
        exit();
    }

}else{
    header('Location: send-message.php');
    exit();
}