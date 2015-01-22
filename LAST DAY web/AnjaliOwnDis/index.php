<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "db_open.php";?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>NETSPACE</title>

<link type="text/css" rel="stylesheet" href="MDMcss.css" />

</head>

<body>
	
  <?php include "navibar.php";?>
        
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
                    $insert .= "VALUES ('".$_SESSION['userid']."', 'Receiver', '$bar', '$time')";
                    $INS = mysql_query($insert);
                } 
                
                $query = mysql_query('SELECT * FROM WallPosts JOIN Users ON WallPosts.Sender = Users.ID ORDER BY WallPosts.Identifier DESC');
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
                            
                            $insert2 = "INSERT INTO Comments (post, Comment, Time, Poster) ";
                            $insert2 .= "VALUES ('".$_POST['postPimp']."', '$bar2', '$time2', '".$_SESSION['userid']."')";
                            $INS2 = mysql_query($insert2);
                        } 
                        
                        
                        while($row=mysql_fetch_array($query))
                        {                       
                            echo "<br/><u>" . $row['User'] . "</u><br/>" . $row['Message'] . "<br/>" . $row['Time'] . "<br/>";
                                    
                			////////COMMENTS///////////////////////////////////////////////////////////////////
                    
                            echo "<div style='font-size:10pt; padding-left:30px;'>";
                            $query2 = mysql_query('SELECT * FROM Comments JOIN Users ON Comments.Poster = Users.ID HAVING Comments.post = "'.$row['Identifier'].'"');
                            if(!$query2)	echo "<br/> ERROR: " . mysql_error() . "<br/>";
                                
                            if(mysql_num_rows($query2) == 0)
                            {
                                echo "Be The First to leave a comment!";
                            }
                            else if (mysql_num_rows($query2) > 0)
                            {
                                while($row2=mysql_fetch_array($query2))
                                {	
                                    echo "<br/><u>" . $row2['User'] . "</u><br/>" . $row2['Comment'] . "<br/>Time: " . $row2['Time'] . "<br/>";				
                                }
                                    
                            }
                                
                            echo '
                                <form method="post">
                                Leave A Comment! <textarea name="comment" rows="3" cols="20" ></textarea>
                                <input type="submit" value="Submit"/>
                                <input type="hidden" name="postPimp" value="'.$row['Identifier'].'" />
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