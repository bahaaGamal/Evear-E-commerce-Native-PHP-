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

$found = false;
foreach($cart as &$item){
  if($item['id'] == $id){
    $item['qty']++;
    $found = true;
    break;
  }
}

if(!$found){
  foreach($products as $product){
    if($product['id'] == $id){
      $product['qty'] = 1;
      $cart [] = $product;
      break;
    }
  }
}

$_SESSION['cart'] = $cart;
var_dump($_SESSION['cart']);

header("location: ../index.php");
// exit();

