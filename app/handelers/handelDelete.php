<?php

$id = $_GET['id'];

$jsonData = file_get_contents('../../Data/post.json');
$data = json_decode($jsonData, true);
$posts =$data['posts'];

if(!is_numeric($id)){
  header("location: ../../blog.php");
  exit();
}

$exists = false;
foreach($posts as $key => $post){
  if($post['id'] == $id){
    unset($posts[$key]);
    $data['posts']=$posts;
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('../../Data/post.json', $jsonData);
    $exists = true;
    break;
  }
}

if(!$exists){
  header("location: ../../blog.php");
  exit();
}

header("location: ../../blog.php");


