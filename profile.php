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
    <title>Spendwise - Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="profilescript.js"></script>
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
            /* padding: 50px 0; */
            font-size: 30px;
            }

            @media (max-width: 768px) {
            .grid-container{
                grid-template-columns: auto;
            }
            .main{
                flex-direction: column;
            }
        }
        body {
            background-color: #f4f4f9;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 17px auto;
            /* width : 500px; */
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            padding: 10px 30px;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #90EE90;
        }
        .main{
            display:flex;
        }

    </style>
</head>
<body>
    <?php
        function current_month_income(){
            global $conn;
            $sql="SELECT SUM(amount) as sum FROM user_income WHERE YEAR(date)=YEAR(CURDATE()) AND MONTH(date)=MONTH(CURDATE())";
            $result=mysqli_query($conn,$sql);
            $current_month_income=0;
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $current_month_income=$row['sum'];
            }
            return $current_month_income;

        }

        function total_income(){
            global $conn;
            $sql="SELECT SUM(amount) as sum FROM user_income";
            $result=mysqli_query($conn,$sql);
            $total_income=0;
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $total_income=$row['sum'];
            }
            return $total_income;

        }
    ?>
    <div class="grid-container">
        <div>Current Month Income <br> Rs. <?php if(current_month_income()){echo current_month_income();}else{echo "0";}?></div>
        <div>Total Income <br> Rs. <?php if(total_income()){echo total_income();}else{echo "0";}?></div>
    </div>

    <?php $name=$_SESSION['username'];?>
    <div class="main">
    <div class="form-container">
        <h2 class="text-center mb-4">Change Password</h2>
        <form action="" id="uploadForm1">
            <div class="form-group">
                <!-- <label for="date">Date</label> -->
                <input type="password" class="form-control" placeholder="Enter current password..." name="password" id="password">
                <p id="passwordErr"></p>
            </div>
            <div class="form-group">
                <!-- <label for="date">Date</label> -->
                <input type="password" class="form-control" placeholder="Enter new password..." name="password1" id="password1">
                <p id="password1Err"></p>
            </div>
            <div class="form-group">
                <!-- <label for="date">Date</label> -->
                <input type="password" class="form-control" placeholder="Enter new password again..." name="password2" id="password2">
                <p id="password2Err"></p>
            </div>
            <center><p id="status1"></p></center>
            <button type="button" id="btn1" class="btn btn-custom btn-block">Save</button>
        </form>
    </div>
    <div class="form-container">
        <h2 class="text-center mb-4">Change Username</h2>
        <form action="" id="uploadForm2">
            <div class="form-group">
                <input type="text" id="username" class="form-control" placeholder="Enter new username..." name="username">
                <p id="usernameErr"></p>
            </div>
            <center><p id="status2"></p></center>
            <button type="button" id="btn2" class="btn btn-custom btn-block">Save</button>
        </form>
    </div>
    </div>
</body>
<script>
    var user_name='<?php echo $name?>';
</script>
</html>