<?php
if(isset($_POST['ingredient'])){
    $ingredient=$_POST['ingredient'];
    $UOM=$_POST['UOM'];

    $con=mysqli_connect("localhost", "root", "", "rms_c451_lk");

    $sql= "INSERT INTO `ingredients`(`ingredientID`, `ingredientName, `inventoryQty`, `UOM`) 
    VALUES (NULL, '$ingredient', NULL, '$UOM');";

    $result= mysqli_query($con,$sql);
    if (mysqli_connect_errno()){
        echo "Connection failed" . mysqli_connect_error();
    } else {

        if($result==true){
            echo"<h3>Added to the database</h3>";
        }
    }
}

?>