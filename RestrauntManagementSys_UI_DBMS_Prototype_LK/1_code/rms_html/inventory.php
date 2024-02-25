<!DOCTYPE html>
<html onload="window.localStorage.removeItem('ingredientName', 'inventoryQty', 'UOM', 'itemAssociation');" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Lance Keith">
    <title>FoodView | Inventory</title>
    <link rel="stylesheet" href="style.css">

    <style>
        tr:hover {
            cursor: pointer;
            opacity: 0.5;
        }

    

        .modal {
            display: none; 
            position: fixed; 
            z-index: 100; 
            padding-top: 80px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
}

        .modalContent {
            background-color: #BFEDFF;
            margin: auto;
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 40px;
            border: 1px solid black;
            width: 40%;
            height: 40%;
            align-content: center;
            text-align: center;
            justify-content: center;
            }

            fieldset {
                border: none;
            }
        
    </style>
</head>

<body>
    <nav>
        <a href="floorMap.php">Floormap</a>
        <a href="waitlist.php">Waitlist</a>
        <a href="cookqueue.php">CookQueue</a>
        <a class="inactive-link" href="inventory.php">Inventory</a>
    </nav>
    <br>
    <!--<table class="fixedHeader">
    <thead>
    <tr>
        <th>Ingredient</th>
        <th>Item Associations</th>
        <th>QTY</th>
        <th>UOM</th>
    </tr>
    </thead>
    </table> -->
    <table id="inventoryTable">

        <thead>
            <tr class="fixedHeader">
                <th>Ingredient</th>
                <th>Item Associations</th>
                <th>QTY</th>
                <th>UOM</th>
                <th style="width: 10px;">Delete Item</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = mysqli_connect("localhost","root", "", "rms_c451_lk");
            $results = mysqli_query($conn,"SELECT ingredientName, itemAssociation, inventoryQty, UOM FROM ingredients");
            while($row = mysqli_fetch_array($results)) {
            ?>
                <tr>
                    <td><?php echo $row['ingredientName']?></td>
                    <td><?php echo $row['itemAssociation']?></td>
                    <td><input class="inputMatch" style="margin:0px;position: relative;width:50px;right:0px;" type="number" value="<?php echo $row['inventoryQty']?>"name="inventoryQty1"
                        placeholder=""></td>
                    <td><?php echo $row['UOM']?></td>
                    <td><button onclick="deleteRecord(this);"><b>&times;</b></button></td>
                </tr>
                
            <?php
             } $conn -> close();
            ?>
            
        </tbody>
    </table>
    <button class="willHide" id="addIngredient" onclick="addIngredient();">
        <img style="border-radius:100%;height:20px; width:20px;" src="images/plusicon.jpg">
        &nbsp;Add Ingredient
    </button>
    <fieldset class="formHide">
   <form action="" method="POST" id="theForm" class="formHide">
        <input class="inputMatch" style="margin-top:10px;" type='text' id='ingredient' name="ingredientName2" placeholder="Ingredient" />
        <input class="inputMatch" style="margin-top:10px;" type='text' id='association' name="itemAssociation2" placeholder="Item Association" />
        <input class="inputMatch" style="position: relative;width:50px;right:0px;" type="number" id="inventoryQty" name="inventoryQty2"  placeholder=''>
        <input class="inputMatch" style="margin-top:10px;" type='text' id='UOM'name="UOM2" placeholder="UOM" />
        <input class="inputMatch" style="display: inline-flex;justify-content: center;align-items: center;
            margin-top: 10px;padding: 5px;background-color: #396C80;color: white;border: none;border-radius: 5px;" type="submit"
            value="Save" name="submit" method="POST" onclick="submitData(); reset();" >
        <input class="inputMatch" style=" display: inline-flex;justify-content: center;align-items: center;
            margin-top: 10px;padding: 5px;background-color: rgb(189, 29, 29);color: white;border: none;border-radius: 5px;"
            type="button" value="Cancel" onclick="hideForm();">
    </form>
    </fieldset>
<?php

$conn = mysqli_connect("localhost","root", "", "rms_c451_lk");
    if(isset($_POST['submit'])){

        $ingredientName  = $_POST['ingredientName2'];
        $itemAssociation = $_POST['itemAssociation2'];
        $inventoryQty  = $_POST['inventoryQty2'];
        $UOM = $_POST['UOM2'];

        $sqli = "INSERT INTO ingredients (ingredientName, itemAssociation, inventoryQty, UOM) VALUES ('$ingredientName', '$itemAssociation', '$inventoryQty', '$UOM');";
            
            $rs = mysqli_query($conn, $sqli);

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $conn -> close();
        }
            ?>

    <!--<div id="checkModal" class="modal">
        

       Check modal 
        <div class="modalContent" id="modalCheck">
          <span class="close">&times;</span>
          <h1>Are you sure you want to delete?</h1>
          <p>The ingredient will be permanently deleted from the database. 
            <br>This can not be undone.</p>
            <button onclick="deleteRecord(this);">Yes, Delete</button>    
            <button onclick="closeModal();">No, Cancel</button>          
        </div>  
        </div>-->

</body>
<script>

    //this is a vestige when I was trying to communicate with the db
    $(document).ready(function () {
        $("tr").click(function () {
            $("tr").removeClass("highlight");
            $(this).addClass("highlight");
        });
    });

    function Send_Data() {
        var ingredient = document.getElementById('ingredient').value;
        var UOM = document.getElementById('UOM').value;
        var httpr = new XMLHttpRequest();
        htppr.open("POST", "get_data.php", true);
        httpr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpr.onreadystatechange = function () {
            if (httpr.readyState == 4 && httpr.status == 200) {
                document.getElementById("response").innerHTML = httpr.responseText;
            }
        }
        httpr.send("ingredient=" + ingredient + "&UOM" + UOM);
    }

    function deleteRecord(ing) {
        $(ing).parents("tr").remove();
    }


        function submitData() { //This is what adds a row in inventory.
    var table = document.getElementById("inventoryTable");
    var row = table.insertRow();
    var ingredient = row.insertCell(0);
    var association = row.insertCell(1);
    var qty = row.insertCell(2);
    var UOM = row.insertCell(3);
    var del = row.insertCell(4)
    ingredient.innerHTML = document.getElementById('ingredient').value;
    association.innerHTML = document.getElementById('associations').value;
    qty.innerHTML = document.getElementById('inventoryQty').value;
    UOM.innerHTML = document.getElementById('UOM').value;
    del.innerHTML = `<button onclick="deleteRecord(this);"><b>&times;</b></button>`;
} 
</script>
<script type="text/javascript" src="jquery-3.6.3.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" src="main.js"></script>
</html>

