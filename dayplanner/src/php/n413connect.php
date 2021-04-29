<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

$dbhost = 'localhost:3306'; //XAMPP is 'localhost:3306'
$dbuser = 'root';
$dbpwd  = ''; //XAMPP password is ''
$dbname = 'n413';
$link = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);
if (!$link) { die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error()); }
?>