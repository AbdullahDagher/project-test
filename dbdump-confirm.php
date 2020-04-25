<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$database = 'messagesystem';
$user = 'root';
$pass = '';
$host = 'localhost';
$path = 'C:\\xampp\\mysql\\bin\\';
$dir = dirname(__FILE__) . '\dbdump.sql';

exec("{$path}mysqldump  --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);

$_SESSION['success'] = "you successfully made a dump of the database in the project directory in this path  {$dir}";
header('Location: dbdump.php');
exit();
