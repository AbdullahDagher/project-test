<?php

    $dsn = 'mysql:host=db4free.net;dbname=abdullahdagher77';
    $dataBaseUserName = 'abdullahdagher77';
    $dataBasePassword = 'abdullahdagher77';
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    try{
        $con = new PDO($dsn, $dataBaseUserName, $dataBasePassword, $option);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch (PDOException $e){
        echo $e->getMessage();
    }
