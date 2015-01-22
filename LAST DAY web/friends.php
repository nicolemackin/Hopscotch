<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "db_open.php" ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Hopscotch - Friends</title>

<link type="text/css" rel="stylesheet" href="MDMcss.css" />

</head>

<body>
<?php include "layout.php"?>
<?php session_start(); ?>
        
        <div id="main" style="text-align:center;top: 20vw; position: absolute; left:0; right:0;">
        <?php
				$userID = $_SESSION['userid']; // reads user id
				
				 $relQ = "SELECT Users.User, Users.ID, Users.Points, Users.About, Users.profilePicName
						FROM Users
						JOIN Friends ON Friends.User1 = Users.ID OR Friends.User2 = Users.ID
						WHERE (Friends.User1 = '$userID' OR Friends.User2 = '$userID')
						AND Users.ID != '$userID'
						";
                
                if($relQ===false)
                    echo mysql_error();
				
				$rel = mysql_query($relQ);
								
				if($rel===false)
					 echo mysql_error();
					 			
				while($query = mysql_fetch_assoc($rel))
				{
					
					echo "</br> Friends Name: ";
					echo $query['User'];
					
					echo "</br> Points: ";
					echo $query['Points'];
					
					echo "</br> About Them: ";
					echo $query['About'];
					
					//$pic = $query['profilePicName'];
					//$picTag = '<img src="' . $pic . '" id="' . $query['ID'] . '" width="100" height="100">';
					//echo $picTag;
					
					echo '</br> <a href="' . "home.php?id=" . $query['ID'] . '">Visit My Page</a>';
					
					echo '</br> ------------------------------</br> </br> </br>';
				}
		?>	
    	</div>

</body>

<?php include_once "db_close.php" ?>
</html>