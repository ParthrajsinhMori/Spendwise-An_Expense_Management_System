<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="registerscript.js"></script>
  <style>
    .header {
      background-color: #007bff;
      color: white;
      padding: 2px 0;
      text-align: center;
    }
    .header h1 {
      margin: 0;
    }
    body {
      background-color: #f8f9fa;
    }
    .register-container {
      max-width: 400px;
      margin: 25px auto;
      /* margin: 50px auto; */
      padding: 20px;
      background-color: #ffffff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #007bff;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .login-link {
      text-align: center;
      margin-top: 20px;
    }
    a {
      text-decoration: none;
    }
    a:hover {
      text-decoration: none;
    }
  </style>
</head>
<body>
  <?php
    include "connection.php";
    $email=$username=$password1=$password2="";
    $emailErr=$usernameErr=$password1Err=$password2Err=$passwordErr="";

    function test_input($data){
      $data=trim($data);
      $data=htmlspecialchars($data);
      $data=strip_tags($data);
      return $data;
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
      $email=test_input($_POST["email"]);
      $username=test_input($_POST["username"]);
      $password1=test_input($_POST["password1"]);
      $password2=test_input($_POST["password2"]);
      $flag=0;
      
      // echo $emailErr; 
      
      if(empty($password1)){
        $password1Err="<span style='color:red;'>Password is Required</span>";
      }
      else{
        $k=0;
        $error="<span style='color:red;'>Must Contain atleast one ";
        $uppercase=preg_match("/[A-Z]/",$password1);
        $lowercase=preg_match("/[a-z]/",$password1);
        $digits=preg_match("/[0-9]/",$password1);
        $special=preg_match("/\W/",$password1);

        $q=0;
        if($uppercase==0){
          $error.="uppercase";
          $q=1;
        }
        if($lowercase==0){
          if($q==0){
            $error.="lowercase";
            $q=1;
          }
          else{
            $error.=", lowercase";
          }
        }
        if($digits==0){
          if($q==0){
            $error.="number";
            $q=1;
          }
          else{
            $error.=", number";
          }
        }
        if($special==0){
          if($q==0){
            $error.="special symbol";
            $q=1;
          }
          else{
            $error.=", special symbol";
          }
        }
        if(strlen($password1)<8){
          if($q==0){
            $error="<span style='color:red;'>Password Length must be atleast 8 characters";
            $q=1;
          }
          else{
            $error.=" and length atleast 8 characters";
          }
        }
        $error.="</span>";
        if($q!=0){
          $password1Err=$error;
        }
        else{
          $flag++;
        }
      }
      if(empty($password2)){
        $password2Err="<span style='color:red;'>Enter again the same password</span>";
      }
      else{
        $k=0;
        $error="<span style='color:red;'>Must Contain atleast one ";
        $uppercase=preg_match("/[A-Z]/",$password2);
        $lowercase=preg_match("/[a-z]/",$password2);
        $digits=preg_match("/[0-9]/",$password2);
        $special=preg_match("/\W/",$password2);

        $q=0;
        if($uppercase==0){
          $error.="uppercase";
          $q=1;
        }
        if($lowercase==0){
          if($q==0){
            $error.="lowercase";
            $q=1;
          }
          else{
            $error.=", lowercase";
          }
        }
        if($digits==0){
          if($q==0){
            $error.="number";
            $q=1;
          }
          else{
            $error.=", number";
          }
        }
        if($special==0){
          if($q==0){
            $error.="special symbol";
            $q=1;
          }
          else{
            $error.=", special symbol";
          }
        }
        if(strlen($password2)<8){
          if($q==0){
            $error="<span style='color:red;'>Password Length must be atleast 8 characters";
            $q=1;
          }
          else{
            $error.=" and length atleast 8 characters";
          }
        }
        $error.="</span>";
        if($q!=0){
          $password2Err=$error;
        }
        else{
          $flag++;
        }
        if($password1!=$password2){
          if($q==0){
            $passwordErr="<span style='color:red;'>Both Password must be same</span>";
          }
          else{
            $passwordErr="<span style='color:red;'>, Both Password must be same</span>";
          }
        }
        else{
          $flag++;
        }
      }
      // echo $flag; 
    }
  ?>
<header class="header">
  <h3><a href="register.php" style="color:white;">SpendWise - An Expense Management System</a></h3>
</header>

<div class="register-container">
  <h2 class="text-center">Register</h2>
  <form action="" id="uploadForm">
        <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email;?>">
        <p id="emailErr"></p>
        </div>
        <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="<?php echo $username;?>">
        <p id="usernameErr"></p>
        </div>
        <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password1" value="<?php echo $password1;?>">
        <p id="password1Err"></p>
        </div>
        <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" class="form-control" id="confirmPassword" placeholder="Enter Password Again" name="password2" value="<?php echo $password2;?>">
        <p id="password2Err"></p>
        </div>
        <button type="button" class="btn btn-primary btn-block" id="btn">Register</button>
    </form>
    <div class="login-link">
        Already Registered? <a href="login.php">Login</a>
    </div>
</div>


</body>
</html>



