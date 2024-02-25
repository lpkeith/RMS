<?php
        $con = mysqli_connect('localhost', 'root', '', 'rms_c451_lk');

            $ingredientName   = $_POST['ingredientName'];
            $inventoryQty  = $_POST['inventoryQty'];
            $UOM = $_POST['UOM'];

            $sql = "INSERT INTO `ingredients` (ingredientID, ingredientName, inventoryQty, UOM) VALUES ('', '$ingredientName', '$inventoryQty', '$UOM');";
            
            $rs = mysqli_query($con, $sql);

            if($rs)
            {
                echo "data inserted";
            }
            
            ?>      