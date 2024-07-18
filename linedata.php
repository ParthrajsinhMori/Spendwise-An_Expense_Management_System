<?php include "connection.php";?>

<?php
    $sql="SELECT date,SUM(amount) as sum FROM user_expense WHERE YEAR(date)=YEAR(CURDATE()) AND MONTH(date)=MONTH(CURDATE()) GROUP BY date";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $data[]=array(
                '0'=>$row['date'],
                '1'=>(int)$row['sum']
            );
        }
        echo json_encode($data);
    }
    else{
        echo "0";
    }

?>