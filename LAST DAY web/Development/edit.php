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
        
        <div id="main">
        <?php
$userID = 1; //using one for now

$edit = "SELECT Users.User, Users.Music, Users.profilePicName, Users.About, Users.Dream FROM Users WHERE Users.ID = $userID";

$edit = mysql_query($edit);
                
if($edit===false)
     echo mysql_error();
                    
while($query = mysql_fetch_assoc($edit))
{
	$User = $query["User"];
	$Music = $query["Music"];
	$About = $query["About"];
	$Dream = $query["Dream"];
	$ProfilePic = $query["profilePicName"];
}
?>

<form>

Username:</br>
<input type="text" name="User" <?php echo "value=\"$User\""; ?> >
</br>

Music Embed Code:</br>
<input type="text" name="Music" <?php echo "value=\"$Music\""; ?> >
</br>

<!-- Profile Code Picker -->

About:</br>
<textarea cols="40" rows="5" name="About">
<?php echo "$About"; ?>
</textarea>
</br>

Dream: </br>
<textarea cols="40" rows="5" name="Dream">
<?php echo "$Dream"; ?>
</textarea>
</br>
</form>

        	
    	</div>

</body>

<?php include_once "db_close.php" ?>
</html>