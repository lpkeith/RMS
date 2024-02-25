<html>
    <head>
        <script>
            function Send_Data() {
                var ingredient=document.getElementById('ingredient').value;
                var UOM=document.getElementById('UOM').value;
                var httpr = new XMLHttpRequest();
                htppr.open("POST", "get_data.php", true);
                httpr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                httpr.onreadystatechange = function(){
                    if(httpr.readyState == 4 && httpr.status == 200){
                        document.getElementById("response").innerHTML=httpr.responseText;
                    }
                }
                httpr.send("ingredient="+ingredient+"&UOM"+UOM);
            }
        </script>
    </head>
    <body>
        

    </body>
</html>