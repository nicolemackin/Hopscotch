<?php
	
	include "db_open.php";
	
	if(isset($_GET['uname']))
	{
		$username = $_GET['uname'];
		
		$sqlCheckUser = "SELECT ID FROM Users WHERE NameUser='$uname'";
		$resultCheckUser = mysql_query($sqlCheckUser);
		
		if($resultCheckUser)
		{
			if(mysql_num_rows($resultCheckUser) > 0)
				echo "0";
			else
				echo "1";
		}
		else
			echo "2";
	}
	else
		echo "2";
	
	
	include "db_close.php";
?>