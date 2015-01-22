<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "db_open.php" ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Game</title>

<link rel="stylesheet" type="text/css" href="game.css">
</head>

<body>

<div id="whole">
        
  <?php include "NavBar.php"; ?>
  
  <div id="main">
  
  
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