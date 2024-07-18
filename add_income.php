<?php
    session_start();
?>
<?php
    if(!isset($_SESSION["username"])){
        echo "<script type='text/javascript'>window.location.href='login.php'</script>";
    }
?>
<?php include "header.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spendwise - Add Income</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

    <script src="addexpensescript.js"></script>
</head>
<body>
    <div class="form-container">
        <h2 class="text-center mb-4">Income Form</h2>
        <form action="" id="uploadForm">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date">
                <p id="dateErr"></p>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category">
                    <option value="0" disabled selected>Select Category</option>
                    <option value="1">Salary</option>
                    <option value="2">Freelancing</option>
                    <option value="3">Part time</option>
                    <option value="4">Stock Market</option>
                    <option value="5">Others</option>
                </select>
                <p id="categoryErr"></p>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount here">
                <p id="amountErr"></p>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="1" placeholder="Add any additional information here" name="message"></textarea>
            </div>
            <center><p id="status"></p></center>
            <button type="button" id="btn" class="btn btn-custom btn-block">Add</button>
        </form>
    </div>
</body>
<?php $file_name=basename($_SERVER['PHP_SELF']);?>

<script>
    var file_name="<?php echo"$file_name"?>";
</script>
</html>