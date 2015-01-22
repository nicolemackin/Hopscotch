<?php

include 'db_open.php';

session_start();

$query = mysql_query('SELECT * FROM WallPosts');
if(!$query)	echo "<br/> ERROR: " . mysql_error() . "<br/>";
	
if(mysql_num_rows($query) == 0)
{
	echo "Sorry... No wall posts were found";
}
else if (mysql_num_rows($query) > 0)
	{
		 while($row=mysql_fetch_array($query))
		{  
			echo "<br/>Sender: " . $row['Sender'] . "<br/>Message: " . $row['Message'] . "<br/>" . $row['Time'] . "<br/>";
		}

	}
	
	
include 'db_close.php';
?>
 