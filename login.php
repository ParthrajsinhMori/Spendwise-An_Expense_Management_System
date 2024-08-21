<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
      margin: 100px auto;
      /* margin: 25px auto; */
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
    $email=$password="";
    $emailErr=$passwordErr="";

    function test_input($data){
      $data=trim($data);
      $data=htmlspecialchars($data);
      $data=strip_tags($data);
      return $data;
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
      $email=test_input($_POST["email"]);
      $password=test_input($_POST["password"]);
      $flag=0;
      if(empty($email)){
        $emailErr="<span style='color:red;'>Email is Required</span>";
      }
      else{
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
          $flag++;
        }
        else{
          $emailErr="<span style='color:red;'>Invalid email address</span>";
        }
      }
      // echo $emailErr; 
      if(empty($password)){
        $passwordErr="<span style='color:red;'>Password is Required</span>";
      }
      else{
        $flag++;
      }
      
      // echo $flag;
      if($flag==2){
        $sql="SELECT * FROM user_data WHERE email='$email'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==1){
            $k=$password;
            $password=md5($password);
            $sql="SELECT * FROM user_data WHERE (email='$email' AND password='$password')";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)==1){
                // echo "<script>alert('Logged in Successfully');</script>";
                $_SESSION["user"]=$email;
                $row=mysqli_fetch_assoc($result);
                $_SESSION["username"]=$row["username"];
                echo "<script type='text/javascript'>window.location.href='index.php'</script>";
            }
            else{
                $passwordErr="<span style='color:red;'>Incorrect Password</span>";
                $password=$k;
            }
        }
        else{
            $emailErr="<span style='color:red;'>User does not exists. Check email address</span>";
        }
      } 
    }
  ?>
<header class="header">
  <h3><a href="register.php" style="color:white;">SpendWise - An Expense Management System</a></h3>
</header>

<div class="register-container">
  <h2 class="text-center">Login</h2>
  <form action="" method="post">
        <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email;?>">
        <?php echo $emailErr;?>
        </div>
        <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?php echo $password;?>">
        <input type="checkbox" onclick="myFunction()"> <label for="showpassword">Show Password</label><br>
        <?php echo $passwordErr;?>
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Login">
    </form>
    <div class="login-link">
        Not Registered yet? <a href="register.php">Register</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

</body>
</html>



