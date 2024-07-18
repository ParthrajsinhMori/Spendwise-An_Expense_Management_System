<?php include "connection.php";?>

<?php

    $email=$_GET["email"];
    // echo $email;

    $sql="SELECT * FROM user_income WHERE email='$email' ORDER BY date DESC";
    $result=mysqli_query($conn,$sql);

    // echo mysqli_num_rows($result);

    if(mysqli_num_rows($result)>0){
        // echo "<div class='container mt-5' style='margin-top: 1rem !important;'>
        // <table class='table table-custom' style='border-collapse: separate; border-spacing: 0 15px; width: 100%;'>
        //     <thead>
        //         <tr>
        //             <th style='background-color: #343a40; color: white; padding: 15px; position: sticky; top: 0; z-index: 1;'>Date</th>
        //             <th style='background-color: #343a40; color: white; padding: 15px; position: sticky; top: 0; z-index: 1;'>Category</th>
        //             <th style='background-color: #343a40; color: white; padding: 15px; position: sticky; top: 0; z-index: 1;'>Amount</th>
        //             <th style='background-color: #343a40; color: white; padding: 15px; position: sticky; top: 0; z-index: 1;'>Message</th>
        //             <th style='background-color: #343a40; color: white; padding: 15px; position: sticky; top: 0; z-index: 1;'>Actions</th>
        //         </tr>
        //     </thead>
        //     <tbody id='mytable'>";
        while($row=mysqli_fetch_assoc($result)){
            // echo "<tr style='background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease;'>";
            // echo "<td style='padding: 15px;'>".date_format(date_create($row['date']), "d-m-Y")."</td>";
            // echo "<td style='padding: 15px;'>".$row['category']."</td>";
            // echo "<td style='padding: 15px;'>"."Rs.".$row['amount']."</td>";
            // echo "<td style='padding: 15px;'>".$row['additional_info']."</td>";
            // echo "<td><button id='btnEdit' data-sid=".$row[srno].">Edit</button><button id='btnDelete'>Delete</button></td>";
            // echo "</tr>";
            $data[]=$row;
        }
    //     echo  "</tbody>
    //     </table>
    // </div>";
    echo json_encode($data);
    }
    else{
        // echo "0";
        echo json_encode(new stdClass);
    }

?>