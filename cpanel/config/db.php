<?php

session_start();

require_once(__DIR__ . '/../controller/LoginClass.php');
require_once(__DIR__ . '/../controller/RegisterClass.php');
require_once(__DIR__ . '/../controller/ProductClass.php');
require_once(__DIR__ . '/../controller/CategoryClass.php');
require_once(__DIR__ . '/../controller/CartClass.php');

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'DB_WasteWays';

try {
  $conn = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXception $e){
  echo $e->getMessage();
}

$login = new LoginClass($conn);
$register = new RegisterClass($conn);
$product = new ProductClass($conn);
$category = new CategoryClass($conn);
$cart = new CartClass($conn);
?>

