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
        $username=test_input($_POST["username"]);
        $email=$_SESSION['user'];
        $sql="UPDATE user_data SET username='$username' where email='$email'";
        $result=mysqli_query($conn,$sql);
        if($result){
            $_SESSION["username"]=$username;
            echo "changed";
        }
    }


    



?>