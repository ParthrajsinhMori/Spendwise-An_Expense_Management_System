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
<script src="expensescript.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spendwise - Expenses</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            padding: 10px 30px;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-custom:hover {
            background-color: bisque;
        }
        .container-custom {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }
        .search-input {
            width: 100%;
            max-width: 400px;
            padding: 10px 20px;
            border-radius: 50px;
            border: 2px solid #007bff;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .search-input:focus {
            border-color: #0056b3;
        }
        @media (max-width: 768px) {
            .container-custom {
                flex-direction: column;
                align-items: center;
            }
            .search-input {
                margin-bottom: 10px;
            }
        }
        .table-custom thead th {
            cursor: pointer;
        }
        .btn{
            margin:1px;
        }
    </style>
</head>
<body>
    <div class="container-custom">
        <button type="button" class="btn btn-custom" id="btn">Add Expense</button>
        <input type="search" class="search-input" placeholder="Search..." id="input">
    </div>

    <p id="output"></p>
    <?php $email=$_SESSION["user"]; ?>
</body>
<script>
    var email='<?php echo $email?>';
    console.log(email);
    // var xhr=new XMLHttpRequest();
    // xhr.open("GET","getexpense.php?email="+email,true);
    // xhr.onprogress=function(){
    //     console.log("progress");
    // }
    // xhr.onload=function(){
    //     if(this.status==200){
    //         var k=this.responseText.trim();
    //         if(k=="0"){
    //             $("input").hide();
    //             // $("button").css("left-margin","100%");
    //             console.log("jquery");
    //         }
    //         document.getElementById("output").innerHTML=this.responseText;
    //         console.log("load");
    //     }
    // }
    // xhr.send();

    console.log('jquery');
    $.ajax({
        url : 'getexpense.php?email='+email,
        method : 'get',
        dataType:'json',
        success:function(response){
            // console.log(Object.keys(response));
            // console.log(response);

            if(Object.keys(response).length==0){
                $("input").hide();
            }
            let output="<div class='container mt-5' style='margin-top: 1rem !important;'><table class='table table-custom' style='border-collapse: separate; border-spacing: 0 15px; width: 100%;'><thead>";
            output+="<tr><th style='background-color: #343a40; color: white; padding: 15px; position: sticky; top: 0; z-index: 1;'>Date</th><th style='background-color: #343a40; color: white; padding: 15px; position: sticky; top: 0; z-index: 1;'>Category</th><th style='background-color: #343a40; color: white; padding: 15px; position: sticky; top: 0; z-index: 1;'>Amount</th><th style='background-color: #343a40; color: white; padding: 15px; position: sticky; top: 0; z-index: 1;'>Message</th><th style='background-color: #343a40; color: white; padding: 15px; position: sticky; top: 0; z-index: 1;'>Actions</th>";
            output+="</tr></thead><tbody id='mytable'>";
            for(i=0;i<response.length;i++){
                // output+="<tr style='background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease;'>"+"<td style='padding: 15px;'>"+response[i].date+"</td>"+"<td style='padding: 15px;'>"+response[i].category+"</td>"+"<td style='padding: 15px;'>"+response[i].amount+"</td>"+"<td style='padding: 15px;'>"+response[i].additional_info+"</td>"+"<td><button id='btnEdit' class='edit' data-sid="+response[i].srno+">Edit</button><button id='btnDelete' class='delete' data-sid="+response[i].srno+">Delete</button></td>"+"</tr>";
                output+="<tr style='background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease;'>"+"<td style='padding: 15px;'>"+response[i].date+"</td>"+"<td style='padding: 15px;'>"+response[i].category+"</td>"+"<td style='padding: 15px;'>"+response[i].amount+"</td>"+"<td style='padding: 15px;'>"+response[i].additional_info+"</td>"+"<td><a href='update_expense.php?no="+response[i].srno+"' style='color:green;'>Edit</a>"+ " " +"<a href='delete_expense.php?no="+response[i].srno+"' style='color:red;'>Delete</a></td>"+"</tr>";
            }
            $('#output').html(output);
        }
    });

    // $('#mytable').on("click","#btnEdit",function(){
    //     console.log("clicked");
    // });
    // console.log();
    $('.delete').click(function(){
        $(this).hide();
      });
</script>
<!-- <script src="expensescript.js"></script> -->
</html>