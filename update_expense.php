<?php
    session_start();
?>

<?php
    if(!isset($_SESSION["username"])){
        echo "<script type='text/javascript'>window.location.href='login.php'</script>";
    }
?>

<?php include "connection.php";?>
<?php include "header.php";?>

<?php
    function test_input($data){
        $data=trim($data);
        $data=htmlspecialchars($data);
        $data=strip_tags($data);
        return $data;
      }

    $srno=$_GET["no"];
    $email=$_SESSION["user"];
    // echo $srno;

    $sql="SELECT * FROM user_expense WHERE email='$email' AND srno=$srno";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $date=$row['date'];
        $category=$row['category'];
        $amount=$row['amount'];
        $message=$row['additional_info'];

    }
    else{
        echo "<script type='text/javascript'>alert('Expense does not exists')</script>";
        echo "<script type='text/javascript'>window.location.href='expense.php'</script>";
    }

?>

<?php
    $arr=["Food","Transport","Entertainment","Utilities","Others"];
    for($i=0;$i<5;$i++){
        if($arr[$i]==$category){
            $category=$i;
            break;
        }
    }
    // echo $category;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spendwise - Update Expense</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="addexpensescript.js"></script>
    <style>
        body {
            background-color: #f4f4f9;
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 17px auto;
            /* width : 500px; */
        }
        .form-group label {
            font-weight: bold;
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
    </style>
</head>
<body>
<div class="form-container">
        <h2 class="text-center mb-4">Update Expense Form</h2>
        <form action="" id="uploadForm">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo $date;?>">
                <p id="dateErr"></p>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category">
                    <option value="0" disabled selected>Select Category</option>
                    <option value="1" <?php if($category==0) echo "selected";?>>Food</option>
                    <option value="2" <?php if($category==1) echo "selected";?>>Transport</option>
                    <option value="3" <?php if($category==2) echo "selected";?>>Entertainment</option>
                    <option value="4" <?php if($category==3) echo "selected";?>>Utilities</option>
                    <option value="5" <?php if($category==4) echo "selected";?>>Others</option>
                </select>
                <p id="categoryErr"></p>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount here" value="<?php echo $amount;?>">
                <p id="amountErr"></p>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="1" placeholder="Add any additional information here" name="message"><?php if(htmlspecialchars($message)!=="No message"){echo htmlspecialchars($message);};?></textarea>
            </div>
            <center><p id="status"></p></center>
            <button type="button" id="btn" class="btn btn-custom btn-block">Update</button>
        </form>
    </div>
    <?php $file_name=basename($_SERVER['PHP_SELF']);?>
</body>
<script>
    var file_name='<?php echo $file_name;?>';
    var srno='<?php echo $srno;?>';
</script>
</html>