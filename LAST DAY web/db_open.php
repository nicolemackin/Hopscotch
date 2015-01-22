<?php

	$dbuser = "mdm2014.02"; // Connect Login
	$dbpass = "JumpiUppe56%"; // Password for ug.csit.carleton.ca

	$resLink = mysql_connect('localhost',$dbuser,$dbpass);
	if(!$resLink) 
	{
		echo "Connect failed<br/>"; 
		exit();
	}
	
	$resSelect = mysql_select_db($dbuser,$resLink);
	if(!$resSelect) 
	{
		echo "Select failed<br/>";
		exit();
	}

?>