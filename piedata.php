<?php include "connection.php";?>

<?php
    $sql="SELECT category,SUM(amount) as count FROM user_expense WHERE YEAR(date)=YEAR(CURDATE()) AND MONTH(date)=MONTH(CURDATE()) GROUP BY category ORDER BY SUM(amount) DESC";
    $result=mysqli_query($conn,$sql);
    $output="";
    if(mysqli_num_rows($result)>0){
        // $output.="{";
        while($row=mysqli_fetch_assoc($result)){
            $data[] = array(
                'name' => $row['category'],
                'y' => (int)$row['count']
            );
        }
        echo json_encode($data);
    }
    else{
        echo "0";
    }
?>