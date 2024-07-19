<?php
session_start();
include("../core/functions.php");
include("../core/validations.php");
$errors = [];


if(checkRequestMethod("POST") && checkPostInput("comment")){

  $id = $_GET['id'];

  $jsonData = file_get_contents('../../Data/post.json');
  $data = json_decode($jsonData, true);
  $posts =$data['posts'];

  if(!is_numeric($id)){
    header("location: ../../blog-post.php?id=$id");
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
    header("location: ../../blog-post.php?id=$id");
    exit();
  }


  // Check Post Type
  foreach($_POST as $key => $value){
    $$key= sanitizeInput($value);
  }

  // Validations
  // Comment
  if(!requiredVal($comment)){
    $errors[] = "Comment is required";
  }elseif(!minVal($comment,1)){
    $errors[] = "Comment must be greater than 1 chars";
  }elseif(!maxVal($comment,50)){
    $errors[] = "Comment must be smaller than 50 chars";
  }


  // Name
  if(!requiredVal($name)){
    $errors[] = "Name is required";
  }elseif(!minVal($name,3)){
    $errors[] = "Name must be greater than 3 chars";
  }elseif(!maxVal($name,30)){
    $errors[] = "Name must be smaller than 30 chars";
  }


  // check Errors And Store Data
if(empty($errors)){
  // Store Data
  

foreach($posts as &$post){
  if($post['id'] == $id){
    if(!isset($post['comments'])){
      $commentId =1;
    }else{
      echo "bahaa";
      $lastComment= end($post['comments']);
      $commentId = $lastComment['comment_id'] + 1;
    }
    $newComment = [
      "comment_id" => $commentId,
      "comment" => $comment,
      "name" => $name
  ];
  $post['comments'] []= $newComment;
  break;
  }
}

 $data['posts']=$posts;
 $jsonData = json_encode($data, JSON_PRETTY_PRINT);
 file_put_contents('../../Data/post.json', $jsonData);
  // User Redirection
  redirect("../../blog-post.php?id=$id");
}else{
  $_SESSION["errors"] = $errors;
  redirect("../../blog-post.php?id=$id");
  die();
}

}else{
  redirect("../../blog-post.php?id=$id");
}
