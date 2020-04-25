<?php

function encryptData($data){
    $ciphering = "AES-128-CTR";

    $options = 0;

    $encryption_iv = '1234567891011121';

    $encryption_key = "GeeksforGeeks";

    $encryption = openssl_encrypt($data, $ciphering,
        $encryption_key, $options, $encryption_iv);
    return $encryption;
}

function decryptData($data){
    $ciphering = "AES-128-CTR";

    $options = 0;

    $encryption_iv = '1234567891011121';

    $encryption_key = "GeeksforGeeks";

    $encryption = openssl_decrypt($data, $ciphering,
        $encryption_key, $options, $encryption_iv);
    return $encryption;
}

//echo decryptData('tAR+IJl7L9V/');