<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hopscotch</title>
</head>

<link type="text/css" rel="stylesheet" href="MDMcss.css" />

    <?php
	session_start();
	
	$me = $_SESSION['userid'];
	if($me == NULL) {}
	else
	{
	$username = "SELECT Users.User, Users.Points
				FROM Users
				WHERE Users.ID = $me
				";
	$user = mysql_query($username);
	if($username===false)
                    echo mysql_error();
	else{
		while($user = mysql_fetch_assoc($user))
		{
			$name = $user['User'];
			$status = $user['Points'];
			if($status == NULL)
			{
				$status = 'newbie';	
			}
			else if($status>=50 && $status < 100)
			{
				$status = 'regular';
			}
			else if($status >=100 && $status <200)
			{
				$status = 'model citizen';	
			}
			else if($status >=200 && $status< 500)
			{
				$status='veteran';
			}
			else if($status >=500)
			{
				$status ='superhero';	
			}
			else
			{
				$status='bad guy';	
			}
		}
	}
	?> 

<body bgcolor="#566472">
	<!--header!-->
	<a href="home.php"><img style="position:absolute; left:0%; top:0%; width:100%;" src="images/mdm_01.png"/></a>
    <!-- buttons! -->
	<!-- messages -->
    <a href="messages.php"><img style="position:absolute; left:0%; top: 11.7vw; width:12.6%;" src="images/mdm_02.png"
    				onmouseover="src='images/mdmHov_02.png'"
					onmouseout="src='images/mdm_02.png'"/></a>
	<!-- friends -->
    <a href="friends.php"><img style="position:absolute; left:12.6%; top: 11.7vw; width:12.6%;" src="images/mdm_03.png"
    				onmouseover="src='images/mdmHov_03.png'"
					onmouseout="src='images/mdm_03.png'"/> </a>
	<!-- games -->
    <a href="game.php"><img style="position:absolute; left:25.2%; top: 11.7vw; width:15.1%;" src="images/mdm_04.png"
   					onmouseover="src='images/mdmHov_04.png'"
					onmouseout="src='images/mdm_04.png'"/> </a>
	<!-- events -->
    <a href="events.php"><img style="position:absolute; left:59.75%; top: 11.7vw; width:15.0%;" src="images/mdm_06.png"
    				onmouseover="src='images/mdmHov_06.png'"
					onmouseout="src='images/mdm_06.png'"/> </a> 
	<!-- help-->
    <a href="help.php"><img style="position:absolute; left:74.75%; top: 11.7vw; width:12.7%;" src="images/mdm_07.png"
    				onmouseover="src='images/mdmHov_07.png'"
					onmouseout="src='images/mdm_07.png'"/> </a>
	<!-- logout -->
    <a href="logout.php"><img style="position:absolute; left:87.45%; top: 11.7vw; width:12.5%;" src="images/mdm_08.png"
    				onmouseover="src='images/mdmHov_08.png'"
					onmouseout="src='images/mdm_08.png'"/></a>
                    
	<div style="position: absolute; left: 0; right: 0; top: 13vw; text-align: center; font-size:24px; color:#FFF; font-family:Chalkduster, comic sans MS;">
	<?php
	echo $name; //echo username
	?>
    </div>
    <div style="position: absolute; left: 0; right: 0; top: 17vw; text-align: center; font-size:18px; color:#FF6B6B; font-family:'Short Stack', Chalkduster, 'comic sans MS';">
    <?php
	echo $status; //echo status
	}
	?>
    </div>
</body>
</html>