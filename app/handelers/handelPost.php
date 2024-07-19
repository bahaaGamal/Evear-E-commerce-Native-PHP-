<?php
session_start();
include("../core/functions.php");
include("../core/validations.php");
$errors = [];

if(checkRequestMethod("POST") && checkPostInput("title")){


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
  $jsonData = file_get_contents('../../Data/post.json');
  $data = json_decode($jsonData, true);
  if(!isset($data['posts'])){
    $id =1;
  }else{
    $lastPost= end($data['posts']);
    $id = $lastPost['id'] + 1;
  }
  $newPost = [
    "id" => $id,
    "title" => $title,
    "description" => $description,
    "post_creator" => $post_creator
];
 $data['posts'][]=$newPost;
 $jsonData = json_encode($data, JSON_PRETTY_PRINT);
 file_put_contents('../../Data/post.json', $jsonData);
  // User Redirection
  redirect("../../blog.php");
}else{
  $_SESSION["errors"] = $errors;
  redirect("../../add-post.php");
  die();
}

}else{
  redirect("../../add-post.php");
}
