<?php
 $con = mysqli_connect("localhost","root", "", "rms_c451_lk");


 $sql = "SELECT tblName FROM `tbls` WHERE tbleOccupied = 0;";

 $all_tables = mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Lance Keith">
    <title>FoodView | Waitlist</title>
    <link rel="stylesheet" href="style.css">
    
    <style>

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

        .close {
  color: #607680;
  float: right;
  font-size: 30px;
  font-weight: bold;
  margin-top: 1px;
}

        .close:hover,
        .close:focus {
  color: #396C80;
  cursor: pointer;
}

        .barSeat {
            width: 60px;
            background-color: #396C80;
            height: 60px;
            border: solid rgb(11, 44, 75) 2px;
            border-radius: 100%;
            position: absolute;
        }

        .barSeat:hover, .table:hover .bigtop:hover, .couple:hover{
            opacity: .85;
        }

        button:click {
            opacity: .5;
        }

        .bar {
            background-color: #814aa1;
            border: solid rgb(44, 11, 75) 2px;
            position: absolute;
        }

        .floor{
            display: block;
            margin-top: 30px;
            padding: 0px;
            border: 0px;
            width: 100%;
            height: 100%;
            background-color: #bec9cf;
            opacity: 1;
            position: relative;
        }

        .table, .bigtop, .couple {
            background-color: #396C80;
            border: solid rgb(11, 44, 75) 2px;
            border-radius: 8%;
            position: absolute;
        }

</style>
</head>
<body>
    <nav> 
        <a href="floorMap.php">Floormap</a>        
        <a class="inactive-link" href="waitlist.html">Waitlist</a>
        <a href="cookqueue.php">CookQueue</a>
        <a href="inventory.php">Inventory</a>
        </nav>
        <br>
    <table id="waitTable">   
    <thead>
        <tr class="fixedHeader">
            <th>Customer Name</th>
            <th>Party Size</th>
            <th>Phone Number</th>
            <th>Notes</th>
            <th>Est. Wait Time</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Joe Smith</td>
            <td>1</td>
            <td>(317) 555-5555</td>
            <td>Lorem ipsum sic</td>
            <td>15 mins.</td>
            <td>
            <button id="assignTable">Assign Table</button>
            <button style="background-color: purple"><img style="width:20px; border-radius: 100%;" src="images/active-call-phone-icon-593497.png">Call</button>
            <button style="background-color: green"><img style="width:20px; border-radius: 100%;" src="images/sms-.jpg">Text</button>
            </td>
        </tr>
    </tbody>
    </table> 
    <button class="willHide" id="newCustomer" onclick="newCustomer()">
        <img style="border-radius:100%;height:20px; width:20px;" src="images/plusicon.jpg"> 
        &nbsp;New Customer
    </button>

<div id="mapModal" class="modal">

  <!-- Modal map -->
  <div class="modalContent" id="contentMap">
    <span class="close">&times;</span>
    <form action="" method="post">
    <h1>Available Tables:</h1>
    <select style="width:250px;" name="tables">
    <?php
                while ($tbl = mysqli_fetch_array(
                        $all_tables,MYSQLI_ASSOC)):;
            ?>
                <option value="<?php echo $tbl['tblName'];
                ?>">
                    <?php echo $tbl['tblName'];
                    
                    ?>
                </option>
            <?php
                endwhile;
    
            ?>
            <?php 
    
            if(isset($_POST['update'])){
                $tbl = $_POST['tblName'];
                    $query = "UPDATE tbls 
                    SET tbleOccuppied = true 
                    WHERE tblName ='$tbl'";
            }
            
?>
        </select>
        <input name="update" value="Assign" type="submit">
        </form>
  </div>  
  </div>
<form id="waitForm" class="formHide">
    <input class="inputMatch"style="margin-top:10px;" type='text' id='custName' placeholder="Name" />
    <input class="inputMatch"style="margin-top:10px;" type='number' id='ptySize' placeholder="Party Size" />
    <input class="inputMatch"style="margin-top:10px;" type='text' id='custPhone' placeholder="Phone Number" />
    <input class="inputMatch"style="margin-top:10px;" type='text' id='listNotes' placeholder="Notes" />
    <input class="inputMatch" style="display: inline-flex;justify-content: center;align-items: center;
    margin-top: 10px;padding: 5px;background-color: #396C80;color: white;border: none;border-radius: 5px;" 
    type="button" value="Save" onclick="addCustomer(); reset();">
    <input class="inputMatch" style=" display: inline-flex;justify-content: center;align-items: center;
    margin-top: 10px;padding: 5px;background-color: rgb(189, 29, 29);color: white;border: none;border-radius: 5px;" 
    type="button" value="Cancel" onclick="hideForm(); reset();">
    </form>
    
</body>
<script type="text/javascript" src="main.js"></script>
<script>
var modal = document.getElementById("mapModal");

// Get the button that opens modal
var btn = document.getElementById("assignTable");

// Get <span> element that closes modal
var span = document.getElementsByClassName("close")[0];

// When user clicks button, open
btn.onclick = function() {
  modal.style.display = "block";
}

// When user clicks <span> (x), close
span.onclick = function() {
  modal.style.display = "none";
}

// closes if clicked outside of modal
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 

/* this never worked unfortunatelty. I really wanted it to, but could not figure it out. 

   function openMap() {
    $.post("floormap.html", function(data){

    $("#contentMap").html(data).fadeIn();

    });

}*/
</script>
<script type="text/javascript" src="jquery-3.6.3.js"></script>
</html>