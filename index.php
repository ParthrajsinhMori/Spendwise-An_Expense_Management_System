<?php
    session_start();
?>
<?php
    if(!isset($_SESSION["username"])){
        echo "<script type='text/javascript'>window.location.href='login.php'</script>";
    }
    ?>
<?php include "header.php";?>
<?php include "connection.php";?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spendwise - Dashboard</title>
    <style>
        .grid-container {
            margin-top:75px;
            display: grid;
            grid-template-columns: auto auto;
            gap: 15px;
            background-color: #2196F3;
            padding: 10px;
            margin-left:70px;
            margin-right:70px;
            }

        .grid-container > div {
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 50px 0;
            font-size: 30px;
            }

            @media (max-width: 768px) {
            .grid-container{
                grid-template-columns: auto;
            }
        }
    </style>
</head>
<body>
    <?php
        function today_expense(){
            global $conn;
            $sql="SELECT SUM(amount) AS sum  FROM user_expense WHERE date=CURDATE()";
            $result=mysqli_query($conn,$sql);
            $today_expense=0;
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $today_expense=$row['sum'];
            }

            return $today_expense;
        }

        function curr_month_expense(){
            global $conn;
            $sql="SELECT SUM(amount) AS sum  FROM user_expense WHERE YEAR(date)=YEAR(CURDATE()) AND MONTH(date)=MONTH(CURDATE())";
            $result=mysqli_query($conn,$sql);
            $curr_month_expense=0;
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $curr_month_expense=$row['sum'];
            }

            return $curr_month_expense;
        }

        function curr_year_expense(){
            global $conn;
            $sql="SELECT SUM(amount) AS sum  FROM user_expense WHERE YEAR(date)=YEAR(CURDATE())";
            $result=mysqli_query($conn,$sql);
            $curr_year_expense=0;
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $curr_year_expense=$row['sum'];
            }

            return $curr_year_expense;
        }

        function total_expense(){
            global $conn;
            $sql="SELECT SUM(amount) AS sum  FROM user_expense";
            $result=mysqli_query($conn,$sql);
            $total_expense=0;
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $total_expense=$row['sum'];
            }

            return $total_expense;
        }
    
    ?>
    
    <div class="grid-container">
        <div>Today's Expense<br>Rs. <?php if(today_expense()){echo today_expense();}else{echo "0";}?></div>
        <div>Current Month's Expense <br>Rs. <?php if(curr_month_expense()){echo curr_month_expense();}else{echo "0";}?></div>
        <div>Current Year's Expense <br>Rs. <?php if(curr_year_expense()){echo curr_year_expense();}else{echo "0";}?></div>  
        <div>Total Expense <br>Rs. <?php if(total_expense()){echo total_expense();}else{echo "0";}?></div>
    </div>

</body>
</html>