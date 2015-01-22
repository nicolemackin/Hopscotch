<?php
	
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");

	session_start();

	include_once("db_open.php");

	$me = $_SESSION['UserID'];
				
	$inbox = mysql_query("SELECT Users.User, Messages.Message, Messages.sender
					FROM Messages
					WHERE Messages.sender = $me");

	if(!$inbox)
		echo mysql_error();
	else
	{
		while($text = mysql_fetch_assoc($inbox))
			{
				echo $text['User'].' said:<br/>';
				echo $text['Message'];
				echo '<br/>';
				echo '<br/>';
			}
	}

	include_once("db_close.php");
?>