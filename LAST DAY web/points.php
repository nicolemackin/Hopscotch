<?php include_once "db_open.php"; ?>

<?php
//POINTS SYSTEM
//Nicole Mackin
//allows users to earn points from playing games and not causing trouble

$me = $_SESSION['userid'];

$points = "SELECT Points
			FROM Users
			WHERE Users.ID = $me
			";
$points = mysql_query($points);
if($points===false)
	echo mysql_error();
						
$points = mysql_fetch_assoc($points);
$pnts = $points['Points'];

$pnts +=1;

$setpnts = "UPDATE Users
			SET Users.Points=$pnts
			WHERE Users.ID =$me 
		";

$setpnts = mysql_query($setpnts);
if($setpnts===false)
	echo mysql_error();
?>