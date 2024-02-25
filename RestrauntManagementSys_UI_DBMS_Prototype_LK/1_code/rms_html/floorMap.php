<?php
 $con = mysqli_connect("localhost","root", "", "rms_c451_lk");


 $sql = "SELECT tbleOccupied FROM `tbls` WHERE tblName = 'Table 1';";

 $tblstat = mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Lance Keith">
    <title>FoodView | Floormap</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .barSeat {
            width: 60px;
            height: 60px;
            background-color: #396C80;
            border: solid rgb(11, 44, 75) 2px;
            border-radius: 100%;
            position: absolute;
            box-shadow: 1px 2px 2px 1px rgb(107, 107, 107);
        }

        .barSeat:hover,
        .table:hover {
            opacity: .85;
        }

        button:click {
            opacity: .5;
        }

        .floor {
            margin-top: 10px;
            padding: 0px;
            border: 0px;
            width: 98%;
            height: 90%;
            background-color: #bec9cf;
            opacity: 1;
            position: absolute;
            box-shadow: inset 6px 6px 10px 0 rgba(0, 0, 0, 0.2),
            inset -6px -6px 10px 0 rgba(255, 255, 255, 0.5);
        }

        #bar {
            border-right: none;
            top: 700px;
            left: 50px;
            width: 500px;
            height: 100px;
        }

        .bar {
            top: 0px;
            left: 0px;
            width: 500px;
            height: 100px;
        }

        #barVertical {
            left: 550px;
            top: 700px;
            width: 100px;
            height: 410px;
        }

        .barVertical {
            left: 0px;
            top: 0px;
            width: 100px;
            height: 410px;
        }

        .table,
        .bigtop,
        .couple {
            background-color: #396C80;
            border: solid rgb(11, 44, 75) 2px;
            border-radius: 8%;
            position: absolute;
            box-shadow: 1px 2px 2px 1px rgb(107, 107, 107);
        }

        .bar,
        .barVertical,
        #bar,
        #barVertical,
        #edBar,
        #edBV {
            background-color: #814aa1;
            border: solid rgb(44, 11, 75) 2px;
            position: absolute;
            box-shadow: 1px 2px 2px 1px rgb(107, 107, 107);
            
        }

        #movableBarSeat {
            left: 0;
            top: 0;
            width: 60px;
            height: 60px;
            border-radius: 100%;
        }

        #movableTable,
        .table {
            width: 250px;
            height: 175px;
        }

        #movableBigtop,
        .bigtop {
            width: 175px;
            height: 425px;
        }

        #movableCouple,
        .couple {
            width: 125px;
            height: 60px;
        }

        #movableBarSeat,
        #movableTable,
        #movableBigtop,
        #movableCouple {
            background-color: #396C80;
            border: solid rgb(11, 44, 75) 2px;
            position: absolute;
            cursor: pointer;
            z-index: 5;
        }

        #movableTable,
        #movableBigtop,
        #movableCouple {
            border-radius: 8%;

        }

        #movableBarSeat:hover,
        #movableTable:hover,
        #movableBigtop:hover,
        #movableCouple:hover {
            opacity: .85;
        }

        #editor {
            display: grid;
            column-gap: 8px;
            grid-template-columns: repeat(6, 1fr);
            position: absolute;
            background-color: whitesmoke;
            width: 98%;
            height: 175px;
            bottom: 25px;
            border-radius: 15px;
            border: 2px solid #396C80;
            z-index: 25;
            opacity: 0;
            justify-items: center;
            align-content: end;
            justify-content: end;
            align-items: center;
        }

        #editButton {
            position: absolute;
            display: flex;
            right: 5px;
            bottom: 5px;
            height: 35px;
            z-index: 100;
        }

        #edBS {
            height: 25px;
            width: 25px;
            grid-column-start: 1;
            grid-column-end: 2;
            border-radius: 100%;
        }

        #edCT {
            width: 50px;
            height: 24px;
            grid-column-start: 2;
            grid-column-end: 3;
        }

        #edTB {
            width: 72px;
            height: 50px;
            grid-column-start: 3;
            grid-column-end: 4;
        }

        #edBT {
            width: 42px;
            height: 100px;
            grid-column-start: 4;
            grid-column-end: 5;
        }

        #edBar {
            width: 100px;
            height: 20px;
            grid-column-start: 5;
            grid-column-end: 6;
        }

        #edBV {
            width: 20px;
            height: 82px;
            grid-column-start: 6;
            grid-column-end: 7;
        }

        #edBS,
        #edCT,
        #edTB,
        #edBT {
            background-color: #396C80;
            border: solid rgb(11, 44, 75) 2px;
            position: absolute;
        }

        #edBS:hover,
        #edCT:hover,
        #edTB:hover,
        #edBT:hover,
        #edBar:hover,
        #edBV:hover {
            opacity: .4;
            cursor: pointer;
        }

        #deleteMessage,
        .deleteMessage {
            top: 40%;
            left: 33%;
            width: 33%;
            height: 120px;
            background-color: #BFEDFF;
            color: white;
            opacity: 0;
            z-index: 0;
            text-align: center;
            vertical-align: middle;
            position: absolute;
            border-radius: 25px;
        }

        p {
            cursor: default;
        }

        tooltip {
            width: 10px;
            height: 20px;
            color: black;
            background-color: whitesmoke;
            font-style: italic;
            border-radius: 5px;
            border: solid 1px black;
            opacity: .5;
        }
    </style>
</head>

<body>

    <nav>
        <a class="inactive-link" href="floorMap.php">Floormap</a>
        <a href="waitlist.php">Waitlist</a>
        <a href="cookqueue.php">CookQueue</a>
        <a href="inventory.php">Inventory</a>
    </nav>

    <div class="floor">
        <div class="deleteMessage" id="deleteMessage">
            <br>
            <h1>Double-click Object to Delete It</h1>
        </div>
        <button id="editButton" onclick="editor()"><img style="height: 20px; width:20px;" src="images/edit.png">
            &nbsp;Edit Floormap
    </div>
    <!-- leftover from when I was experimenting with moving divs


    <div id="movableBigtop" style="top:100px;left:1050px;"></div>
    <div id="movableTable" style="top:100px;left:75px;"></div>
    <div id="movableCouple" style="top:100px;left:710px;"></div>
    <div id="bar"></div>
    <div id="barVertical"></div> 
    <div name="Table 1" id="movableBarSeat" style="top: 600px;left: 75px;"></div>-->


    <button id="endEdit" onclick="closeEditor()" style="display:flex;opacity:0;
    z-index:0;bottom:170px;right: 25px; position:absolute;"><b>X</b>&nbsp;Close Editor</button>

    <div id="editor">
        <div id="edBS" onclick="addBS()"></div>
        <div id="edCT" onclick="addCT()"></div>
        <div id="edTB" onclick="addTB()"></div>
        <div id="edBT" onclick="addBT()"></div>
        <div id="edBar" onclick="addBar()"></div>
        <div id="edBV" onclick="addBV()"></div>
        <p style="grid-column: 1/2;">Bar Seat</p>
        <p style="grid-column: 2/3;">Couple's Table</p>
        <p style="grid-column: 3/4;">Standard Table</p>
        <p style="grid-column: 4/5;">Big Top</p>
        <p style="grid-column: 5/6;">Bar</p>
        <p style="grid-column: 6/7;">Bar (Vertical)</p>
    </div>
    </div>
</body>
<script>
    document.getElementById("movableBarSeat").addEventListener("click", toggle);

   /* let tblstatus = false;
    

    function toggle() {
        if(tblstatus = tblstatus){
        tblstatus = !tblstatus;
    }       
            if (tblstatus = 0)
            <?php 
             $sql = "UPDATE tbls SET tbleOccupied = 0 WHERE tblName = 'Table 1';"; ?>
            else
            <?php  $sql = "UPDATE tbls SET tbleOccupied = 1 WHERE tblName = 'Table 1';"; ?>
    } */

    function editor() { //activates editor and hides button
        let edit = document.querySelector("#editor");
        let button = document.querySelector("#editButton");
        let exit = document.querySelector("#endEdit");
        edit.style.opacity = ".4";
        endEdit.style.opacity = ".4";
        endEdit.style.zIndex = "100";
        button.style.zIndex = "0";
        button.style.opacity = "0";

        edit.addEventListener("mouseover", function () {
            edit.style.opacity = "0.8";
            endEdit.style.opacity = ".8";
        });

        edit.addEventListener("mouseout", function () {
            edit.style.opacity = "0.4";
            endEdit.style.opacity = ".4";
        });

        endEdit.addEventListener("mouseover", function () {
            endEdit.style.opacity = ".8";
        });

        makeNewDraggable();
        showMessage();
    }

    function removeItems() {
        let item = document.getElementsByClassName("barSeat");
        item.addEventListener("dblclick", function () {
            item.remove();
        });
    }
    function closeEditor() { //deactivivates editor
        let edit = document.querySelector("#editor");
        let button = document.querySelector("#editButton");
        let exit = document.querySelector("#endEdit");
        edit.style.opacity = "0";
        endEdit.style.opacity = "0";
        endEdit.style.zIndex = "0";
        button.style.zIndex = "100";
        button.style.opacity = "1";

        edit.addEventListener("mouseover", function () {
            edit.style.opacity = "0";
            endEdit.style.opacity = "0";
        });

        edit.addEventListener("mouseout", function () {
            edit.style.opacity = "0";
            endEdit.style.opacity = "0";
        });

        stopNewDraggable();
    }


    function dragElement(elmnt) {
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        elmnt.onmousedown = startDrag;


        function startDrag(e) {
            e = e || window.event;
            e.preventDefault();
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = endDrag;
            document.onmousemove = onDrag;
        }

        function onDrag(e) {
            e = e || window.event;
            e.preventDefault();
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }

        function endDrag() {
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }

    function stopDragElement(elmnt) {
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        elmnt.onmousedown = noDrag;


        function noDrag(e) {
            e = e || window.event;
            e.default();
            document.onmouseup = null;
            document.onmousemove = null;
        }

        function onDrag(e) {
            e = e || window.event;
            e.default();
        }

    }
    function idAssigner() { //did I need to repeat each thing? Probably not, but this 
        var cls1 = document.getElementsByClassName("barSeat"); //is how bad my syntax
        for (n = 0, length = cls1.length; n < length; n++) { //knowledge is 
            cls1[n].id = "BS" + (n + 1);
        }
        var cls2 = document.getElementsByClassName("couple");
        for (n = 0, length = cls2.length; n < length; n++) {
            cls2[n].id = "CT" + (n + 1);
        }
        var cls3 = document.getElementsByClassName("table");
        for (n = 0, length = cls3.length; n < length; n++) {
            cls3[n].id = "TB" + (n + 1);
        }
        var cls4 = document.getElementsByClassName("bigtop");
        for (n = 0, length = cls4.length; n < length; n++) {
            cls4[n].id = "BT" + (n + 1);
        }
        var cls5 = document.getElementsByClassName("bar");
        for (n = 0, length = cls5.length; n < length; n++) {
            cls5[n].id = "bar" + (n + 1);
        }
        var cls6 = document.getElementsByClassName("barVertical");
        for (n = 0, length = cls6.length; n < length; n++) {
            cls6[n].id = "BV" + (n + 1);
        }
    };

    function makeNewDraggable() { //yeah this is the same repeat thing
        var cls1 = document.getElementsByClassName("barSeat");
        for (n = 0, length = cls1.length; n < length; n++) {
            dragElement(document.getElementById("BS" + (n + 1)));
        }
        var cls2 = document.getElementsByClassName("couple");
        for (n = 0, length = cls2.length; n < length; n++) {
            dragElement(document.getElementById("CT" + (n + 1)));
        }
        var cls3 = document.getElementsByClassName("table");
        for (n = 0, length = cls3.length; n < length; n++) {
            dragElement(document.getElementById("TB" + (n + 1)));
        }
        var cls4 = document.getElementsByClassName("bigtop");
        for (n = 0, length = cls4.length; n < length; n++) {
            dragElement(document.getElementById("BT" + (n + 1)));
        }
        var cls5 = document.getElementsByClassName("bar");
        for (n = 0, length = cls5.length; n < length; n++) {
            dragElement(document.getElementById("bar" + (n + 1)));
        }
        var cls6 = document.getElementsByClassName("barVertical");
        for (n = 0, length = cls6.length; n < length; n++) {
            dragElement(document.getElementById("BV" + (n + 1)));
        }
    }
    function stopNewDraggable() { //there had to be an easier way to do this but here I am
        var cls1 = document.getElementsByClassName("barSeat");
        for (n = 0, length = cls1.length; n < length; n++) {
            stopDragElement(document.getElementById("BS" + (n + 1)));
        }
        var cls2 = document.getElementsByClassName("couple");
        for (n = 0, length = cls2.length; n < length; n++) {
            stopDragElement(document.getElementById("CT" + (n + 1)));
        }
        var cls3 = document.getElementsByClassName("table");
        for (n = 0, length = cls3.length; n < length; n++) {
            stopDragElement(document.getElementById("TB" + (n + 1)));
        }
        var cls4 = document.getElementsByClassName("bigtop");
        for (n = 0, length = cls4.length; n < length; n++) {
            stopDragElement(document.getElementById("BT" + (n + 1)));
        }
        var cls5 = document.getElementsByClassName("bar");
        for (n = 0, length = cls5.length; n < length; n++) {
            stopDragElement(document.getElementById("bar" + (n + 1)));
        }
        var cls6 = document.getElementsByClassName("barVertical");
        for (n = 0, length = cls6.length; n < length; n++) {
            stopDragElement(document.getElementById("BV" + (n + 1)));
        }
    }

    function addBS() { //adds a barseat
        let newBS = document.createElement("div");
        newBS.style.top = "0";
        newBS.style.left = "0";
        newBS.classList.add("barSeat");
        newBS.title = "Seats: 1; Occupied: No"
        document.body.append(newBS);
        idAssigner();
        makeNewDraggable();
        document.getElementsByClassName("barSeat");
        newBS.addEventListener("dblclick", function () {
            newBS.remove();
        });

        
    }
    function addCT() { //these are going to have the same function
        let newCT = document.createElement("div");
        newCT.style.top = "0";
        newCT.style.left = "0";
        newCT.classList.add("couple");
        newCT.title = "Seats: 2; Occupied: No"
        document.body.append(newCT);
        idAssigner();
        makeNewDraggable();
        document.getElementsByClassName("couple");
        newCT.addEventListener("dblclick", function () {
            newCT.remove();
        });


    }
    function addTB() { //""
        let newTB = document.createElement("div");
        newTB.style.top = "0";
        newTB.style.left = "0";
        newTB.classList.add("table");
        newTB.title = "Seats: 4; Occupied: No"
        document.body.append(newTB);
        idAssigner();
        makeNewDraggable();
        document.getElementsByClassName("table");
        newTB.addEventListener("dblclick", function () {
            newTB.remove();
        });
    }
    function addBT() { //""
        let newBT = document.createElement("div");
        newBT.style.top = "0";
        newBT.style.left = "0";
        newBT.classList.add("bigtop");
        newBT.title = "Seats: 8 - 10; Occupied: No"
        document.body.append(newBT);        
        idAssigner();
        makeNewDraggable();
        document.getElementsByClassName("bigtop");
        newBT.addEventListener("dblclick", function () {
            newBT.remove();
        });
    }
    function addBar() {//""
        let newBar = document.createElement("div");
        newBar.style.top = "0";
        newBar.style.left = "0";
        newBar.classList.add("bar");
        document.body.append(newBar);
        idAssigner();
        makeNewDraggable();
        document.getElementsByClassName("bar");
        newBar.addEventListener("dblclick", function () {
            newBar.remove();
        });
    }
    function addBV() {//""
        let newBV = document.createElement("div");
        newBV.style.top = "0";
        newBV.style.left = "0";
        newBV.classList.add("barVertical");
        document.body.append(newBV);
        idAssigner();
        makeNewDraggable();
        document.getElementsByClassName("barVertical");
        newBV.addEventListener("dblclick", function () {
            newBV.remove();
        });
    }

    function showMessage() { //this shows the delete message then fades out. I bet I could
        let mess = document.getElementById("deleteMessage");//have done a loop for 
        mess.style.opacity = ".5"; //this but I again lack the knowledge of syntax. Sad
        setTimeout(function () {
            mess.style.opacity = ".4";
        }, 750);
        setTimeout(function () {
            mess.style.opacity = ".3";
        }, 1500);
        setTimeout(function () {
            mess.style.opacity = ".2";
        }, 2250);
        setTimeout(function () {
            mess.style.opacity = ".1";
        }, 3000);
        setTimeout(function () {
            mess.style.opacity = ".05";
        }, 3750);
        setTimeout(function () {
            mess.style.opacity = "0";
            mess.style.zIndex = "-8";
        }, 4500);
    }

    function Send_Table_Data() { //Pretty sure this does not even work, I am going to keep it though
        var table = document.getElementById("BS" + (n + 1)).value;
        var httpr = new XMLHttpRequest();
        htppr.open("POST", "get_data.php", true);
        httpr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpr.onreadystatechange = function () {
            if (httpr.readyState == 4 && httpr.status == 200) {
                document.getElementById("response").innerHTML = httpr.responseText;
            }
        }
        httpr.send("ingredient=" + ingredient + "&UOM" + UOM); 
    } //if only it was so simple. https://imageproxy.ifunny.co/crop:x-20,resize:640x,quality:90x75/images/8806bbf2a65f9b2558ac76cabdeab247fdf1fea61d8e38cfb7d76738c897e9ab_1.jpg
</script>
<script type="text/javascript" src="main.js"></script>
<script type="text/javascript" src="jquery-3.6.3.js"></script>
</html>