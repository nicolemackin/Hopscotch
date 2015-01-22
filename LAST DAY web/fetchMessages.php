<?php
	
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");

	session_start();

	include_once("db_open.php");

	$me = $_SESSION['UserID'];
				
	$inbox = mysql_query("SELECT Messages.Message, Messages.sender, Messages.Time 
					FROM Messages  
					WHERE Messages.sender = $me OR Messages.receiver = $me
					ORDER BY Time");

	if(!$inbox)
		echo mysql_error();
	else
	{
		while($text = mysql_fetch_assoc($inbox))
			{
				$sql =  mysql_query("SELECT Users.User, Users.ID 
							FROM Users 
							WHERE Users.ID =".$text['sender']);
							
				while($user = mysql_fetch_assoc($sql))
				{
					$speaker = $user['User'];
				}
							
					echo $speaker.' said:<br/>';
					echo $text['Message'];
					echo '<br/>';
					echo '<br/>';
			}
	}

	include_once("db_close.php");
?>