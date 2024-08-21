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

    $sql="DELETE FROM user_expense WHERE email='$email' AND srno=$srno";
    $result=mysqli_query($conn,$sql);

    if($result){
        echo "<script type='text/javascript'>alert('Expense Deleted Successfully')</script>";
        echo "<script type='text/javascript'>window.location.href='expense.php'</script>";
    }
    else{
        echo "<script type='text/javascript'>alert('Unable to delete Expense')</script>";
        echo "<script type='text/javascript'>window.location.href='expense.php'</script>";
    }

?>

