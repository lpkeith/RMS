function submitData() { //This is what adds a row in inventory.
    var table = document.getElementById("inventoryTable");
    var row = table.insertRow();
    var ingredient = row.insertCell(0);
    var associations = row.insertCell(1);
    var qty = row.insertCell(2);
    var UOM = row.insertCell(3);
    var del = row.insertCell(4)
    ingredient.innerHTML = document.getElementById('ingredient').value;
    associations.innerHTML = document.getElementById('associations').value;
    qty.innerHTML = 
    `<input class="noPad" style="position: relative;width:50px;right:0px;" type="number" value="inputQty" name="quantity" placeholder="--">`;
    UOM.innerHTML = document.getElementById('UOM').value;
    del.innerHTML = `<button onclick="deleteRecord(this);"><b>&times;</b></button>`;
} 

function addCustomer() { //there is probably an easier way to do this, but it is the same thing
  var table = document.getElementById("waitTable");
  var row = table.insertRow();
  var custName = row.insertCell(0);
  var ptySize = row.insertCell(1);
  var custPhone = row.insertCell(2);
  var listNotes = row.insertCell(3);
  var waitTime = row.insertCell(4);
  var listActions = row.insertCell(5);
  custName.innerHTML = document.getElementById('custName').value;
  ptySize.innerHTML = document.getElementById('ptySize').value;
  custPhone.innerHTML = document.getElementById('custPhone').value;
  listNotes.innerHTML = document.getElementById('listNotes').value;
  waitTime.innerHTML = "--"
  listActions.innerHTML = `<button id="assignTable">Assign Table</button>
  <button style="background-color: purple"><img style="width:20px; border-radius: 100%;" src="active-call-phone-icon-593497.png">Call</button>
  <button style="background-color: green"><img style="width:20px; border-radius: 100%;" src="sms-.jpg">Text</button>`;
  
} 

function addItem() { //yeah again
  var table = document.getElementById("cookTable");
  var row = table.insertRow();
  var menuItem = row.insertCell(0);
  var tableID = row.insertCell(1);
  var elapsedTime = row.insertCell(2);
  var cookNotes = row.insertCell(3);
  var cookActions = row.insertCell(4);
  menuItem.innerHTML = document.getElementById('menuItem').value;
  tableID.innerHTML = document.getElementById('tableID').value;
  elapsedTime.innerHTML = "--";
  cookNotes.innerHTML = document.getElementById('cookNotes').value;
  cookActions.innerHTML = `<button onclick="completeOrder(this);" style="background-color: green">Complete</button>
  <button onclick="cancelOrder(this);" style="color: red;background-color:rgba(0,0,0,0);text-decoration:underline;">Unable to complete</button>`;
  
} 

function addIngredient() { //this happends when add ingredient is clicked on inventory
    $('.formHide').css("display" , "block");
    $('.willHide').css("display" , "none");
}

function newCustomer() { //this does the same thing but on the waitlist
  $('.formHide').css("display" , "block");
  $('.willHide').css("display" , "none");
}

function newItem() {  //literally the same again. But named to prevent confusion
  $('.formHide').css("display" , "block");
  $('.willHide').css("display" , "none");
}

function hideForm() { //thiis hides a form. Any form
    $('.formHide').css("display" , "none");
    $('.willHide').css("display" , "inline-flex");
}

/**function addIngredient() {
    let ingredient= prompt("Ingredient:");
    let associations= prompt("Item Associations:");
    let qty= prompt("QTY:");
    let UOM= prompt("UOM:");
} **/