<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Lance Keith">
    <title>FoodView | CookQueue</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .message {
            top: 10%;
            left: 33%;
            width: 33%;
            height: 250px;
            background-color: white;
            color: #396C80;
            opacity: 0;
            z-index: 0;
            text-align: center;
            vertical-align: middle;
            position: absolute;
            border-radius: 25px;
            object-fit: contain;
            align-items: center;
            justify-content: center;
            border: solid black 3px;;
        }
    </style>
</head>
<body>
    <nav> 
        <a href="floorMap.php">Floormap</a>
        <a href="waitlist.php">Waitlist</a>
        <a class="inactive-link" href="cookqueue.php">CookQueue</a>
        <a href="inventory.php">Inventory</a>
        </nav>
        <br>
        <table id="cookTable">   
            <thead>
                <tr class="fixedHeader">
                    <th>Menu Item</th>
                    <th>Table</th>
                    <th>Elapsed Time</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ham Omlette</td>
                    <td>1</td>
                    <td>15 mins.</td>
                    <td>Lorem ipsum sic</td>
                    <td>
                    <button onclick="completeOrder(this);" style="background-color: green">Complete</button>
                    <button onclick="cancelOrder(this);" style="color: red;background-color:rgba(0,0,0,0);text-decoration:underline;">Unable to complete</button>
                    </td>
                </tr>
            </tbody>
            </table> 
            <button class="willHide" id="newItem" onclick="newItem();">
                <img style="border-radius:100%;height:20px; width:20px;" src="images/plusicon.jpg"> 
                &nbsp;Add to Queue
            </button>

        <form id="cookForm" class="formHide">
            <input class="inputMatch"style="margin-top:10px;" type='text' id='menuItem' placeholder="Item" />
            <input class="inputMatch"style="margin-top:10px;" type='number' id='tableID' placeholder="Table" />
            <input class="inputMatch"style="margin-top:10px;" type='text' id='cookNotes' placeholder="Notes" />
            <input class="inputMatch" style="display: inline-flex;justify-content: center;align-items: center;
            margin-top: 10px;padding: 5px;background-color: #396C80;color: white;border: none;border-radius: 5px;" 
            type="button" value="Save" onclick="addItem(); reset();">
            <input class="inputMatch" style=" display: inline-flex;justify-content: center;align-items: center;
            margin-top: 10px;padding: 5px;background-color: rgb(189, 29, 29);color: white;border: none;border-radius: 5px;" 
            type="button" value="Cancel" onclick="hideForm(); reset();">
            </form>

            <div class="message" id="completeMessage">
                <img style="margin:0px;padding:0px;width:100px;border-radius: 100%;" src="images/greencheck.jpg" alt="checkmark">
                <h1>Order Complete</h1>
                <p>A message has been sent to waitstaff.</p>
            </div>
            <div class="message" id="eightySixMessage">
                <img style="margin:0px;padding:0px;width:100px;" src="images/86img.png" alt="86">
                <h1>Menu Item</h1>
                <p>A message has been sent to the customer.</p>
            </div>
</body>
<script>
    function completeOrder(order) {
        $(order).parents("tr").remove();
        showCompleteMessage();
    }

    function cancelOrder(order) {
        $(order).parents("tr").remove();
        showESMessage();
    }
    function showCompleteMessage() { //this shows the complete message. Copied from floor map
        let mess = document.getElementById("completeMessage");
            mess.style.opacity = "1";
        setTimeout(function () {
            mess.style.opacity = ".9";
        }, 3100);
        setTimeout(function () {
            mess.style.opacity = ".8";
        }, 3200);
        setTimeout(function () {
            mess.style.opacity = ".7";
        }, 3300);
        setTimeout(function () {
            mess.style.opacity = ".6";
        }, 3400);
        setTimeout(function () {
            mess.style.opacity = ".5";
        }, 3500);
        setTimeout(function () {
            mess.style.opacity = ".4";
        }, 3600);
        setTimeout(function () {
            mess.style.opacity = ".3";
        }, 3700);
        setTimeout(function () {
            mess.style.opacity = ".2";
        }, 3800);
        setTimeout(function () {
            mess.style.opacity = ".1";
        }, 3900);
        setTimeout(function () {
            mess.style.opacity = ".05";
        }, 4000);
        setTimeout(function () {
            mess.style.opacity = ".005";//yes I made it worse
        }, 4100);
        setTimeout(function () {
            mess.style.opacity = "0";
            mess.style.zIndex = "-8";
        }, 4200);
    }
    function showESMessage() { //ah. more of the same bulky code
        let mess = document.getElementById("eightySixMessage");
        mess.style.opacity = "1"; 
        setTimeout (function () {
            mess.innerHTML = `<img style="margin:0px;padding:0px;width:100px;" src="images/86img.png" alt="86">
                <h1><del>M</del>enu Item</h1>
                <p>A message has been sent to the customer.</p>`
        }, 500);
        setTimeout (function () {
            mess.innerHTML = `<img style="margin:0px;padding:0px;width:100px;" src="images/86img.png" alt="86">
                <h1><del>Me</del>nu Item</h1>
                <p>A message has been sent to the customer.</p>`
        }, 600);
        setTimeout (function () {
            mess.innerHTML = `<img style="margin:0px;padding:0px;width:100px;" src="images/86img.png" alt="86">
                <h1><del>Men</del>u Item</h1>
                <p>A message has been sent to the customer.</p>`
        }, 700);
        setTimeout (function () {
            mess.innerHTML = `<img style="margin:0px;padding:0px;width:100px;" src="images/86img.png" alt="86">
                <h1><del>Menu</del> Item</h1>
                <p>A message has been sent to the customer.</p>`
        }, 800);
        setTimeout (function () {
            mess.innerHTML = `<img style="margin:0px;padding:0px;width:100px;" src="images/86img.png" alt="86">
                <h1><del>Menu </del>Item</h1>
                <p>A message has been sent to the customer.</p>`
        }, 900);
        setTimeout (function () {
            mess.innerHTML = `<img style="margin:0px;padding:0px;width:100px;" src="images/86img.png" alt="86">
                <h1><del>Menu I</del>tem</h1>
                <p>A message has been sent to the customer.</p>`
        }, 1000);
        setTimeout (function () {
            mess.innerHTML = `<img style="margin:0px;padding:0px;width:100px;" src="images/86img.png" alt="86">
                <h1><del>Menu It</del>em</h1>
                <p>A message has been sent to the customer.</p>`
        }, 1100);
        setTimeout (function () {
            mess.innerHTML = `<img style="margin:0px;padding:0px;width:100px;" src="images/86img.png" alt="86">
                <h1><del>Menu Ite</del>m</h1>
                <p>A message has been sent to the customer.</p>`
        }, 1200);
        setTimeout (function () {
            mess.innerHTML = `<img style="margin:0px;padding:0px;width:100px;" src="images/86img.png" alt="86">
                <h1><del>Menu Item</del></h1>
                <p>A message has been sent to the customer.</p>`
        }, 1300);
        setTimeout (function () {
            mess.innerHTML = `<img style="margin:0px;padding:0px;width:100px;" src="images/86img.png" alt="86">
                <h1>86'd</h1>
                <p>A message has been sent to the customer.</p>`
        }, 2000);
        setTimeout(function () {
            mess.style.opacity = ".9";
        }, 3100);
        setTimeout(function () {
            mess.style.opacity = ".8";
        }, 3200);
        setTimeout(function () {
            mess.style.opacity = ".7";
        }, 3300);
        setTimeout(function () {
            mess.style.opacity = ".6";
        }, 3400);
        setTimeout(function () {
            mess.style.opacity = ".5";
        }, 3500);
        setTimeout(function () {
            mess.style.opacity = ".4";
        }, 3600);
        setTimeout(function () {
            mess.style.opacity = ".3";
        }, 3700);
        setTimeout(function () {
            mess.style.opacity = ".2";
        }, 3800);
        setTimeout(function () {
            mess.style.opacity = ".1";
        }, 3900);
        setTimeout(function () {
            mess.style.opacity = ".05";
        }, 4000);
        setTimeout(function () {
            mess.style.opacity = ".005";
        }, 4100);
        setTimeout(function () {
            mess.style.opacity = "0";
            mess.style.zIndex = "-8"; //I made it EVEN MORE insane. I like the effect though tbh
        }, 4200);
    }
</script>
<script type="text/javascript" src="main.js"></script>
<script type="text/javascript" src="jquery-3.6.3.js"></script>
</html>