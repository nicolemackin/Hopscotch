<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "db_open.php" ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>NETSPACE</title>

<link type="text/css" rel="stylesheet" href="MDMcss.css" />

</head>

<body>
     <div class="header">
        <div id="logobar" class="header">
        <img src="logoplaceholder.png" id="logo" >
        </div>
        
        <div id="links">
            <div id="c123">
            <a href="game.php"> <img src="navImgs/gameNorm.png" id="c1" 
                onmouseover="this.src='navImgs/gamePress.jpg'" 
                onmouseout="this.src='navImgs/gameNorm.png'"> </a>
            <a href="index.php"> <img src="navImgs/homeNorm.png" id="c2" 
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
     </div>
        
        <div id="main">
        	<div id="edit"> <h3> EDIT YOUR PROFILE </h3> </div>
            
            <div id="profileUser">
            	<img src="meerProfilePicHP.png" id="profilePic" />
                
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
                  <form method="post">
                Write Wall Post: <textarea name="wallpost" rows="5" cols="45" ></textarea>
                      <input type="submit" value="submit"/>
                  </form>
                  
                  
                 <?php
                if(isset($_POST['wallpost']))
                {
                    $bar = $_POST['wallpost'];
                    $time = date("l jS \of F Y h:i:s A");
                    
                    $insert = "INSERT INTO WallPosts (Sender, Wall, Message, Time) ";
                    $insert .= "VALUES ('1', 'Receiver', '$bar', '$time')";
                    $INS = mysql_query($insert);
                } 
                
                $query = mysql_query('SELECT * FROM WallPosts');
                if(!$query)	echo "<br/> ERROR: " . mysql_error() . "<br/>";
                    
                if(mysql_num_rows($query) == 0)
                {
                    echo "Sorry... No wall posts were found";
                }
                else if (mysql_num_rows($query) > 0)
                    {
                        
                        if(isset($_POST['comment']))
                        {
                            $bar2 = $_POST['comment'];
                            $time2 = date("l jS \of F Y h:i:s A");
                            
                            $insert2 = "INSERT INTO Comments (post, Comment, Time) ";
                            $insert2 .= "VALUES ('".$_POST['postPimp']."', '$bar2', '$time2')";
                            $INS2 = mysql_query($insert2);
                        } 
                        
                        
                        while($row=mysql_fetch_array($query))
                        {
                            //Wall Posts echo
                            //echo "<br/>ID: " . $row['ID'] . "<br/>Sender: " . $row['Sender'] . "<br/> Wall: " . $row['Wall'] . "<br/>Message: " . $row['Message'] . "<br/>Time: " . $row['Time'] . "<br/>";
                            echo "<br/>Sender: " . $row['Sender'] . "<br/>Message: " . $row['Message'] . "<br/>" . $row['Time'] . "<br/>";
                                    
                ////////COMMENTS///////////////////////////////////////////////////////////////////
                    
                            echo "<div style='font-size:9pt;'>";
                            $query2 = mysql_query('SELECT * FROM Comments WHERE post = "'.$row['ID'].'"');
                            if(!$query2)	echo "<br/> ERROR: " . mysql_error() . "<br/>";
                                
                            if(mysql_num_rows($query2) == 0)
                            {
                                echo "Be The First to leave a comment!";
                            }
                            else if (mysql_num_rows($query2) > 0)
                            {
                                while($row2=mysql_fetch_array($query2))
                                {	
                                    echo "<br/>ID: " . $row2['ID'] . "<br/>Message: " . $row2['Comment'] . "<br/>Time: " . $row2['Time'] . "<br/>";				
                                }
                                    
                            }
                                
                            echo '
                                <form method="post">
                                Leave A Comment! <textarea name="comment" rows="3" cols="20" ></textarea>
                                <input type="submit" value="Submit"/>
                                <input type="hidden" name="postPimp" value="'.$row['ID'].'" />
                                </form>
                            ';	  
                            echo "</div>";
                    
                        }		
                        
                    }
                
                 ?>
		</div>

</body>

<?php include_once "db_close.php" ?>
</html>