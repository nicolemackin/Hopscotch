<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "db_open.php" ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>NETSPACE</title>

<link type="text/css" rel="stylesheet" href="MDMcss.css" />

</head>

<body>
        <?php include "NavBar.php"; ?>
        
        <div id="main">
        	<div id="edit"> <h3> EDIT YOUR PROFILE </h3> </div>
            
            <div id="profile">
            	<img src="meerProfilePic.jpg" id="profilePic" />
                
                <h3> FAVOURITE MUSIC </h3>
                <a href="music.html"> NAME OF SONG &#9654 </a> set this up to play music
                </br>
                
                <h3> ABOUT ME</h3>
                <p> YO SUP IM MEER-LY A CAT AND STUFF </p>
                </br>
                
                <h3> MY DREAMS </h3>
                <p> I WANT TO BE MORE THAN A CAT SOMEDAY</p>
                </br>
                 
            </div>
            <div id="profileWall">
            <h3> WALL POSTS </h3>
            <a href="wallpostsWIP_Joshua.php">WIP wallposts Joshua</a>
            <form>
            <textarea rows="5" cols="70%" name="commentArea">COMMENT ON YOUR FRIENDS WALL HERE</textarea>
            </br>
            <input type="submit" value="Submit">
			</form>
            <h5> FRIENDS NAME </h5>
            <p> MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE. </p>
            <h6> COMMENTS </h6>
            </br>
            <h5> FRIENDS NAME </h5>
            <p> MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE. </p>
            <h6> COMMENTS </h6>
            </br>
            <h5> FRIENDS NAME </h5>
           <p> MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE MESSAGE. </p>
            <h6> COMMENTS </h6>
            </div>
    	</div>

</body>

<?php include_once "db_close.php" ?>
</html>
