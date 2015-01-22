<?php include_once "db_open.php" ?>
<?php session_start();?>
<?php

$friend = $_POST['frid'];

$newgame = "INSERT
INTO Game(FriendsID)
VALUES($friend)
";

$newgame = mysql_query($newgame);
                
if($newgame===false)
	echo mysql_error();
	
$game= mysql_insert_id();
header("Location: game.php?game=$game");
http_response_code(303);
?>
<?php include_once "db_close.php" ?>
