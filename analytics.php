<?php
    session_start();
?>
<?php
    if(!isset($_SESSION["username"])){
        echo "<script type='text/javascript'>window.location.href='login.php'</script>";
    }
    ?>
<?php include "header.php";?>
<?php include "connection.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spendwise - Analytics</title>
    <script src="https://code.jscharting.com/latest/jscharting.js"></script>
    <script type="text/javascript" src="https://code.jscharting.com/latest/modules/types.js"></script>
    <script type="text/javascript" src="https://code.jscharting.com/latest/modules/toolbar.js"></script>
</head>
    <style>
        .grid-container {
                margin-top:75px;
                display: grid;
                grid-template-columns: auto auto;
                gap: 15px;
                background-color: #2196F3;
                padding: 10px;
                margin-left:70px;
                margin-right:60px;
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
<body>
    <div class="grid-container">
        <div id="chartDiv1" style="height: 380px;width:600px;"></div>
        <div id="chartDiv2" style="height: 380px;width:600px;"></div>
    </div>
 
    <script>
        fetch('piedata.php')
            .then(response => response.json())
            .then(data => {
                if(Object.keys(data).length==0){
                    // console.log("empty");
                    $('#chartDiv1').html("No data available for displaying");
                    $('#chartDiv1').css("padding","145px 0px");
                }
                else{
                var chart = JSC.Chart('chartDiv1', { 
                    debug: true, 
                    title_position: 'center', 
                    legend: { 
                        template: 'Rs. %value {%percentOfTotal:n1}% %icon %name', 
                        position: 'inside left bottom'
                    }, 
                    defaultSeries: { 
                        type: 'pie', 
                        pointSelection: true
                    }, 
                    defaultPoint_label_text: '<b>%name</b>', 
                    title_label_text: 'Monthly Expense Category wise', 
                    yAxis: { label_text: 'Transactions', formatString: 'n' }, 
                    series: [ 
                        { 
                            name: 'Monthly Expense', 
                            points: data
                        } 
                    ] 
                });
            }
        })
            .catch(error => console.error('Error fetching data:', error));

            fetch('linedata.php')
            .then(response => response.json())
            .then(data => {
                if(Object.keys(data).length==0){
                    // console.log("empty");
                    $('#chartDiv2').html("No data available for displaying");
                    $('#chartDiv2').css("padding","145px 0px");
                }
                else{
                var chart = JSC.chart('chartDiv2', {
                debug: true,
                title_position: 'center', 
                type: 'area',
                title_label_text: 'Monthy Expense Date wise',
                legend_visible: false,
                defaultSeries: {
                shape_opacity: 0.7,
                // color: '#f58e5e',
                defaultPoint_marker: {
                    size: 8,
                    outline: { color: 'white', width: 2 }
                }
                },
                xAxis: { scale_type: 'time' },
                series: [
                {
                    name: 'Purchases',
                    points:data
                }
                ]
            });
        }
    })
        .catch(error => console.error('Error fetching data:', error));

    </script>

</body>

</html>