<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Events</title>
<link type="text/css" rel="stylesheet" href="MDMcss.css" />
</head>
<script>
function changePage(page){
		//create an XMLHttp Object
		var oXMLHttp = new XMLHttpRequest();
		if(oXMLHttp == null) return(null);	
		
		
		//Setup the Connection
		var cURL = "recipe.php?selectedID=" + id;
		oXMLHttp.open("get",cURL,true);
		oXMLHttp.onreadystatechange = function()
		{
			if(oXMLHttp.readyState == 4) //state 4: data recieved
			{
				if(oXMLHttp.status == 200) //Status 200: request was OK
				{
					document.getElementById('info').innerHTML = oXMLHttp.responseText;
					//document.getElementById('infoMsg').innerHTML = "Success!";
				}
				else{
					document.getElementById('infoMsg').innerHTML = "Request failed:" + oXMLHttp.status;
					 }
			}
			else if(oXMLHttp.readyState > 1){
					//document.getElementById('infoMsg').innerHTML = "Wassup!";
				 }
		};
		oXMLHttp.send(null);
	}
</script>
<body>
<div id="whole">
	<?php include_once "db_open.php" ?>
    <?php include "NavBar.php" ?>
   
    <div align="right"><h2>Calender</h2>
    <form>
    <button><caption>prev</caption></button><button><caption>next</caption></button>
    </form>
    <div id="calender"/>
    <?php
		echo "<h3>MONTH</h3>";
		echo "<table border='1';><tr>";
		echo "<tr><td>SUN</td><td>MON</td><td>TUES</td><td>WES</td><td>THURS</td><td>FRI</td><td>SAT</td></tr>";
		for($d=1;$d<=31;$d++){
			echo "<td>{$d}</td>";
			if($d==7||$d==14||$d==21||$d==28){
				echo "</tr><tr>";
			}
			if($d==31){
				echo "</tr>";	
			}
		}
		echo "</table>";
	?>
    </div>
    <div align="left"><h2>My Events</h2></div>
    <?php include_once "db_close.php" ?>
</div>
</body>
</html>