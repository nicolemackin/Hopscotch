<?php
	
	session_start();

	include_once("db_open.php");

	$cMsg = (isset($_REQUEST['uMsg'])) ? $_REQUEST['uMsg'] : "N/A";

	$userID = $_SESSION['UserID'];

	$friendID = $_SESSION['FriendID'];

	$upload = "
		INSERT INTO Messages (Message, sender, receiver, Time) 
		VALUES ('$cMsg', $userID, $friendID, NOW())";	

	$resUpload = mysql_query($upload);

	if($resUpload == false) //Check to see if Message has bee delivered
		echo "Could not deliver message <br/>";

	echo $message;

	include_once("db_close.php");

?>