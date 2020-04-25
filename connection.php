<?php

    $dsn = 'mysql:host=remotemysql.com;dbname=6Cf4IBWjcc';
    $dataBaseUserName = '6Cf4IBWjcc';
    $dataBasePassword = 'P8g9MIMY5R';
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    try{
        $con = new PDO($dsn, $dataBaseUserName, $dataBasePassword, $option);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch (PDOException $e){
        echo $e->getMessage();
    }
