<?php

    $dsn = 'mysql:host=localhost;dbname=id13350236_messagesystem';
    $dataBaseUserName = 'id13350236_root';
    $dataBasePassword = '1RPIDhK-mUG-av';
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    try{
        $con = new PDO($dsn, $dataBaseUserName, $dataBasePassword, $option);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        echo "Connction Error: ".$e->getMessage();
    }
