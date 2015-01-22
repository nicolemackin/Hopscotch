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
        
        <div id="main" style="float:left;">
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

<form id="update" method="POST" Action="edit.php">

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

<input type="submit" value="UPDATE" name="submit"/>
</form>
</div>

<div id="pedit" style="float:right;">
Current Profile Picture:</br>
<input type="text" name="Pic" <?php echo "value=\"$ProfilePic\""; ?> >
</br></br>
Change your profile picture:
<?php

	include "db_open.php";

	if(isset($_FILES['imageFile']['name'])){
		$uploaddir = getcwd(). "/images/";
		$uploadfile = basename($_FILES['imageFile']['name']);
		$uploadpath = $uploaddir . $uploadfile;
		
		if((strcasecmp(substr($uploadfile, -3, 3), "jpg") == 0) || (strcasecmp(substr($uploadfile, -3, 3), "png") == 0) || (strcasecmp($type, "gif") == 0))
		{
			if(!is_file($uploadpath))
			{
				if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadpath))
				{
					$imgData = getimagesize($uploadpath); $type = $imgData['mime'];
					if((strcasecmp($type, "image/jpeg") == 0) || (strcasecmp($type, "image/png") == 0) || (strcasecmp($type, "image/gif") == 0))
					{
						$userID = 1;
						echo "File of a valid type ($type), and was stored as $uploadfile<br/>\n";
						$width = $imgData[0]; $height = $imgData[1];
						$sqlImg = "UPDATE Users SET profilePicName = '".$uploadfile."', ppicWidth = '".$width."', ppicHeight = '".$height."', ppicType = '".$type."' WHERE Users.ID = $userID";
						$resultImg = mysql_query($sqlImg);
						
						if($resultImg)
						{
							if(mysql_affected_rows() == 1)
								echo "Image data inserted into Database, with ID = ", mysql_insert_id();
						}
					}
					else	{
						echo "Failed mime-checking <br/>"; unlink($uploadpath);
					}
				}
				else
					echo "Upload Error, please try again! <br />\n";
			}
			else
				echo "File already exists <br/>\n";
		}
		else
			echo "Only JPEG, PNG, or GIF images are acceptable ($uploadfile) <br/>\n";
	}

	include "db_close.php";
?>

<div>
	<form enctype="multipart/form-data" action="edit.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="800000" />
    <table>
    	<tr>
        	<td width="100px">Image:</td>
            <td><input name="imageFile" type="file" /></td>
        </tr>
      	<tr>
        	<td width="100px">&nbsp;</td>
            <td align="right"><input type="submit" value="Upload" /></td>
        </tr>
    </table>
    </form>
</div>

</div>

<?php if(isset($_POST['submit']))
		{
		$User = isset($_POST['User']) ? $_POST['User'] : '';
		//$Pic = isset($_POST['Pic']) ? $_POST['Pic'] : '';
		$Music = isset($_POST['Music']) ? $_POST['Music'] : '';
		$About = isset($_POST['About']) ? $_POST['About'] : '';
		$Dream = isset($_POST['Dream']) ? $_POST['Dream'] : '';
		
		$updateProfile = "UPDATE Users SET User = '".$User."', Music = '".$Music."', Dream = '".$Dream."', About = '".$About."' WHERE Users.ID = $userID";
		
		$updateProfile = mysql_query($updateProfile);
		
		if($updateProfile===false)
     			echo mysql_error();

		echo "</br> USER: ";	
		echo $User;
		
		echo "</br> MUSIC: ";	
		echo $Music;
		
		echo "</br> ABOUT: ";	
		echo $About;
		
		echo "</br> DREAM: ";	
		echo $Dream;
		
		echo "</br> PIC: ";	
		echo $Pic;
		}
?>
</body>

<?php include_once "db_close.php" ?>
</html>