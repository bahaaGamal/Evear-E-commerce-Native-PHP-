<?php
session_start();
include("../core/functions.php");
include("../core/validations.php");
$errors = [];


if(checkRequestMethod("POST") && checkPostInput("reply")){

  $id = $_GET['id'];
  $comment_id = $_GET['comment_id'];

  $jsonData = file_get_contents('../../Data/post.json');
  $data = json_decode($jsonData, true);
  $posts =$data['posts'];

  if(!is_numeric($id) || !is_numeric($comment_id)){
    header("location: ../../blog-post.php?id=$id");
    exit();
  }
  
  $exists = false;
  foreach($posts as $post){
    if($post['id'] == $id){
      foreach($post['comments'] as $comment){
        if($comment['comment_id'] == $comment_id){
        $exists = true;
        break 2;
        }
      }
    }
  }
  
  if(!$exists){
    header("location: ../../blog-post.php?id=$id");
    exit();
  }


  // Check Reply Type
  foreach($_POST as $key => $value){
    $$key= sanitizeInput($value);
  }

  // Validations
  // Reply
  if(!requiredVal($reply)){
    $errors[] = "Reply is required";
  }elseif(!minVal($reply,1)){
    $errors[] = "Reply must be greater than 1 chars";
  }elseif(!maxVal($reply,50)){
    $errors[] = "Reply must be smaller than 50 chars";
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
    foreach($post['comments'] as &$comment){
      if($comment['comment_id'] == $comment_id){
        if(!isset($comment['replies'])){
          $replyId =1;
        }else{
          $lastReply= end($comment['replies']);
          $replyId = $lastReply['reply_id'] + 1;
        }
        $newReply = [
          "reply_id" => $replyId,
          "reply" => $reply,
          "name" => $name
      ];
      $comment['replies'] []= $newReply;
      break 2;
      }
    }
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
