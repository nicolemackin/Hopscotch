<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "db_open.php" ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>NETSPACE</title>

<link type="text/css" rel="stylesheet" href="MDMcss.css" />

</head>

<body>
        <div id="logobar">
        <img src="logoplaceholder.png" id="logo" >
        </div>
        
        <div id="links">
            <div id="c123">
            <a href="game.php"> <img src="navImgs/gameNorm.png" id="c1" 
                onmouseover="this.src='navImgs/gamePress.jpg'" 
                onmouseout="this.src='navImgs/gameNorm.png'"> </a>
             <a href="home.php"> <img src="navImgs/homeNorm.png" id="c2" 
                onmouseover="this.src='navImgs/homePress.jpg'" 
                onmouseout="this.src='navImgs/homeNorm.png'"></a>
            <a href="messages.php"> <img src="navImgs/messagesNorm.png" id="c3"
                onmouseover="this.src='navImgs/messagesPress.jpg'" 
                onmouseout="this.src='navImgs/messagesNorm.png'"></a>
            </div>
         
            <div id="c456">
            <a href="events.php"> <img src="navImgs/eventsNorm.png" id="c4" 
            onmouseover="this.src='navImgs/eventsPress.jpg'" 
            onmouseout="this.src='navImgs/eventsNorm.png'"> </a>
            <a href="friends.php"> <img src="navImgs/friendsNorm.png" id="c5" 
            onmouseover="this.src='navImgs/friendsPress.jpg'" 
            onmouseout="this.src='navImgs/friendsNorm.png'"> </a>
            <a href="help.php"> <img src="navImgs/helpNorm.png" id="c6" 
            onmouseover="this.src='navImgs/helpPress.jpg'" 
            onmouseout="this.src='navImgs/helpNorm.png'"></a>
            </div>
            
            <div id="identity">
            <h id="name"> YOUR NAME </h> </br>
            <h id="status" > STATUS </h>
            </div>
        </div>
        
        <div id="main" style="text-align:center;">
        <?php
				$userID = 1; //using one for now
				
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
					
					echo '</br> <a href="' . "ugrad.bitdegree.ca/~MDM2014.02/home.php?id=" . $query['ID'] . '">Visit My Page</a>';
					
					echo '</br> ------------------------------</br> </br> </br>';
				}
		?>	
    	</div>

</body>

<?php include_once "db_close.php" ?>
</html>