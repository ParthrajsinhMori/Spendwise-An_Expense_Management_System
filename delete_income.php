<?php
    session_start();
?>

<?php
    if(!isset($_SESSION["username"])){
        echo "<script type='text/javascript'>window.location.href='login.php'</script>";
    }
?>

<?php include "connection.php";?>

<?php

    $srno=$_GET["no"];
    $email=$_SESSION["user"];

    $sql="DELETE FROM user_income WHERE email='$email' AND srno=$srno";
    $result=mysqli_query($conn,$sql);

    if($result){
        echo "<script type='text/javascript'>alert('Income Deleted Successfully')</script>";
        echo "<script type='text/javascript'>window.location.href='income.php'</script>";
    }
    else{
        echo "<script type='text/javascript'>alert('Unable to delete Income')</script>";
        echo "<script type='text/javascript'>window.location.href='income.php'</script>";
    }

?>

