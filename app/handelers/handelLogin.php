<?php
session_start();
include("../core/functions.php");
include("../core/validations.php");
$errors = [];


if(checkRequestMethod("POST") && checkPostInput("email")){


  // Check Post Type
  foreach($_POST as $key => $value){
    $$key= sanitizeInput($value);
  }

  // Validations
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

  // Read Data
  if(empty($errors)){
    // Check Data
    $user_file = fopen("../../data/user.csv","r");
    $data = [];
    while (($row = fgetcsv($user_file, 1000, ',')) !== FALSE) {
        $data[] = $row;
    }
    fclose($user_file);

    // Check Data
    foreach($data as $row){
      if($email == $row[1] && sha1($password) == $row[2]){
        // User Redirection
        $_SESSION["auth"] = [$row[0],$row[1]];
        redirect("../../index.php");
      }
    }

    if(!isset($_SESSION["auth"])){
      $errors[] = "Email or Password is not valid";
      $_SESSION["errors"] = $errors;
      redirect("../../login.php");
    }

  }else{
    $_SESSION["errors"] = $errors;
    redirect("../../login.php");
    die();
  }

}else{
  redirect("../login.php");
}


