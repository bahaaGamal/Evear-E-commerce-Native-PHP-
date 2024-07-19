<?php
session_start();
include("../core/functions.php");
include("../core/validations.php");
$errors = [];


if(checkRequestMethod("POST") && checkPostInput("title")){

  $id = $_GET['id'];

  $jsonData = file_get_contents('../../Data/post.json');
  $data = json_decode($jsonData, true);
  $posts =$data['posts'];

  if(!is_numeric($id)){
    header("location: ../../blog.php");
    exit();
  }
  
  $exists = false;
  foreach($posts as $post){
    if($post['id'] == $id){
      $exists = true;
      break;
    }
  }
  
  if(!$exists){
    header("location: ../../blog.php");
    exit();
  }


  // Check Post Type
  foreach($_POST as $key => $value){
    $$key= sanitizeInput($value);
  }

  // Validations
  // Title
  if(!requiredVal($title)){
    $errors[] = "Title is required";
  }elseif(!minVal($title,3)){
    $errors[] = "Title must be greater than 3 chars";
  }elseif(!maxVal($title,30)){
    $errors[] = "Title must be smaller than 25 chars";
  }


  // Description
  if(!requiredVal($description)){
    $errors[] = "Description is required";
  }elseif(!minVal($description,3)){
    $errors[] = "Description must be greater than 3 chars";
  }elseif(!maxVal($description,250)){
    $errors[] = "Description must be smaller than 250 chars";
  }


  // check Errors And Store Data
if(empty($errors)){
  // Store Data

  foreach($posts as &$post){
    if($post['id'] == $id){
      $post["title"] = $title;
      $post["description"] = $description;
      $post["post_creator"] = $post_creator;
      break;
    }
  }
  
 $data['posts']=$posts;
 $jsonData = json_encode($data, JSON_PRETTY_PRINT);
 file_put_contents('../../Data/post.json', $jsonData);
  // Blog Redirection
  redirect("../../blog.php");
}else{
  $_SESSION["errors"] = $errors;
  redirect("../../add-post.php");
  die();
}

}else{
  redirect("../../add-post.php");
}
