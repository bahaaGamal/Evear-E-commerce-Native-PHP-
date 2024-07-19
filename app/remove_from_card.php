<?php
session_start();
$products = $_SESSION['products'];

// Check Id

$id =$_GET['id'];

if(!is_numeric($id)){
  header("location: ../index.php");
  exit();
}

$exists = false;
foreach($products as $product){
  if($product['id'] == $id){
    $exists = true;
    break;
  }
}

if(!$exists){
  header("location: ../index.php");
  exit();
}

// Check Cart To Add Item

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];


foreach($cart as $key => &$item){
  if($item['id'] == $id){
    unset($cart[$key]);
    break;
  }
}


$_SESSION['cart'] = $cart;
var_dump($_SESSION['cart']);

header("location: ../shop-cart.php");
// exit();

