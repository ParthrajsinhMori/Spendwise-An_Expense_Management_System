<?php include "connection.php";?>

<?php
    session_start();
?>

<?php
    function test_input($data){
        $data=trim($data);
        $data=htmlspecialchars($data);
        $data=strip_tags($data);
        return $data;
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $password=md5(test_input($_POST["password"]));
        $password1=md5(test_input($_POST["password1"]));
        $password2=test_input($_POST["password2"]);
        
        $email=$_SESSION["user"];
        $sql="SELECT password FROM user_data WHERE email='$email'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        if($row['password']!=$password){
            echo "invalid";
        }
        else{
            $query="UPDATE user_data SET password='$password1' WHERE email='$email'";
            $k=mysqli_query($conn,$query);
            if($k){
                echo "updated";
            }
        }
    }

?>