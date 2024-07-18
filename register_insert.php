<?php include "connection.php";?>

<?php
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
        
        $sql="SELECT * from user_data WHERE email='$email'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
        // $emailErr="<span style='color:red;'>User is already registered. Check email id.</span>";
            echo "user_exists";
        }
        else{
        $password1=md5($password1);
        $sql="INSERT INTO user_data(email,username,password) VALUES('$email','$username','$password1')";
        $result=mysqli_query($conn,$sql);
        if($result){
            echo "success";
        }
        else{
            // echo "<script>alert('Unable to Register');</script>";
            echo "userexists";
        }
        }
        }



?>