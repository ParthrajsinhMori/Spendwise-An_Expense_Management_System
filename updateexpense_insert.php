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

    $srno=$_GET["srno"];
    // echo $srno;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $date=test_input($_POST["date"]);
        $category=test_input($_POST["category"]);
        $amount=test_input($_POST["amount"]);
        $message=test_input($_POST["message"]);
        // echo $message;
        if($message==""){
            $message="No message";
        }
        $email=$_SESSION["user"];

        $arr=["Food","Transport","Entertainment","Utilities","Others"];
        $category=$arr[$category-1];
        $sql="UPDATE user_expense SET date='$date',category='$category',amount=$amount,additional_info='$message' WHERE srno=$srno";
        $result=mysqli_query($conn,$sql);
        if($result){
            echo "success";
        }
        else{

        }
    }



?>