<?php
session_start();
include("../core/functions.php");
include("../core/validations.php");
$errors = [];

if(checkRequestMethod("POST") && checkPostInput("name")){


  // Check Post Type
  foreach($_POST as $key => $value){
    $$key= sanitizeInput($value);
  }

  // Validations
  // Name
  if(!requiredVal($name)){
    $errors[] = "name is required";
  }elseif(!minVal($name,3)){
    $errors[] = "Name must be greater than 3 chars";
  }elseif(!maxVal($name,25)){
    $errors[] = "Name must be smaller than 25 chars";
  }


  // Email
  if(!requiredVal($email)){
    $errors[] = "email is required";
  }elseif(!emailVal($email)){
    $errors[] = "Please type a valid email";
  }

  // Password
  if(!requiredVal($password)){
    $errors[] = "Password is required";
  }elseif(!minVal($password,6)){
    $errors[] = "Password must be greater than 6 chars";
  }elseif(!maxVal($password,20)){
    $errors[] = "Password must be smaller than 20 chars";
  }

  // Confirm Password
  if(!requiredVal($confirmPassword)){
    $errors[] = "Confirm Password is required";
  }elseif($confirmPassword != $password){
    $errors[] = "Confirm Password must be equal Password";
  }

  // check Errors And Store Data
if(empty($errors)){
  // Store Data
  $user_file = fopen("../../data/user.csv","a+");
  $data = [$name,$email,sha1($password)];
  fputcsv($user_file, $data);
  fclose($user_file);
  // User Redirection
  $_SESSION["auth"] = [$name,$email];
  redirect("../../index.php");
}else{
  $_SESSION["errors"] = $errors;
  redirect("../../sign-up.php");
  die();
}

}else{
  redirect("../../sign-up.php");
}
