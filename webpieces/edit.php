<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "db_open.php" ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>NETSPACE</title>

<link type="text/css" rel="stylesheet" href="MDMcss.css" />

</head>

<body>
      <?php include "layout.php" ?>
        <div id="main" style="top: 20vw; position: absolute;>
        <?php
$userID = $_SESSION['userid']; // reads user id

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