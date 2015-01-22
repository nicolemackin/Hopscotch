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
        
        <div id="logobar">
        <img src="logoplaceholder.png" id="logo" >
        </div>
        
        <div id="links">
            <div id="c123">
            <a href="game.php"> <img src="circGameTeal.png" id="c1" > </a>
            <a href="index.php"><img src="circTeal.png" id="c2" ></a>
            <a href="Messages.php"><img src="circTeal.png" id="c3" ></a>
            </div>
            
            <div id="c456">
            <a href="wallpostsWIP_Joshua.php"><img src="circTeal.png" id="c5" ></a>
            <img src="circTeal.png" id="c6" >
            <img src="circTeal.png" id="c4" >
            </div>
            
            <div id="identity">
            <h id="name"> YOUR NAME </h> </br>
            <h id="status" > STATUS </h>
            </div>
        </div>
        
        <div id="main">

<h1>Say The Same Thing</h1>
<br/>
   
    <h4>How to Win:</h4>
    <p>Guess the same word!</p>
    
    <h4>How To Play:</h4>
    <ol>
        <li>Pick a word, any word!</li>
        <li>Wait for other player to say a word</li>
        <li>Find a common word between the two words!
        <ol>
            <ul>Example: Bananas and Coding! What do they have in common?</ul>
            <ul>Chris Joslin!</ul>
        </ol>
        </li>
        
    </ol> 
    
    <h4>Rules:</h4>
    <ol>
        <li>No swearing</li>
        <li>No cheating</li>
        <li>Have Fun!</li>
    </ol>
    <br/>

<a href="game.php"/> Return to Start </a>


<?php

//$me = $_GET['id'];
$me = 1;


	if( isset($_GET['word']) && (isset($_GET['round'])) )
	{
		$gid = $_GET['game'];
		$rid = $_GET['round'];
		$word = $_GET['word'];
		
		$friend = "
		SELECT Friends.User1, Friends.User2
		FROM Friends
		JOIN Game ON Game.FriendsID = Friends.ID
		WHERE Game.ID = $gid
		";
		
		$friend = mysql_query($friend);
		if($friend===false)
			echo mysql_error();
			
		$myid = mysql_fetch_assoc($friend);
		if($myid['User1'] = $me)
			$itsme = "User1Word";
		else
			$itsme = "User2Word";
		
		
		
		$rid += 1;
		
		$findround ="
		SELECT count(*)
		FROM GameRound
		WHERE GameRound.GameID = ".$gid."
		AND GameRound.RoundID = ".$rid
		;
		
		$findround = mysql_query($findround); // inserts into appropriate round
		
		if($findround===false)
			echo mysql_error();
		
		$row = mysql_fetch_row($findround);
		$rows = $row[0];
		
			if($rows == 1)
				{ // Round does exists
					
					$saveword = "
						UPDATE GameRound
						SET $itsme = '$word'
						WHERE GameRound.GameID = ".$gid."
						AND GameRound.RoundID = ".$rid 
						; // inserts into appropriate game
				}
				else
				{
					$saveword = "
					INSERT INTO GameRound(RoundID, $itsme, GameID) VALUES($rid, '$word', $gid)
					";
				}
		
				$saveword = mysql_query($saveword); //insert word into GameRound table under User1Word or User2Word
		
					if($saveword===false)
						echo mysql_error();
		
	
		
	}
	else if(isset($_GET['game']))
	{
		$friend = "
		SELECT Users.User
		FROM Users
		JOIN Friends ON (Friends.User1 = Users.ID OR Friends.User2 = Users.ID)
		JOIN Game ON Game.FriendsID = Friends.ID
		WHERE Users.ID !=".$me
		;
		$friendname = mysql_query($friend);
		$name = mysql_fetch_assoc($friendname);
		
		if($name===false)
			echo mysql_error();
		
		?>
        
        <h2>Game with <?php echo $name['User']; ?></h2>
		<br/>
        
        <?php
		
		
		$gid = $_GET['game'];
		$round = 'SELECT GameRound.User1Word, GameRound.User2Word, GameRound.RoundID
				FROM GameRound
				WHERE GameRound.GameID = '.$gid.'
				ORDER BY GameRound.RoundID
		';
		
		
		echo"<table class='wordlist'>";
		$round = mysql_query($round);
		
		if($round===false)
			echo mysql_error();
		
		while($row = mysql_fetch_assoc($round))
		{
			$user1word = $row['User1Word'];
			$user2word = $row['User2Word'];
			
			echo "
			<tr>
				<td>
					<b>Round $row[RoundID]</b>
				</td>
				<td>
					$row[User1Word]
				</td>
				<td>
					$row[User2Word]
				</td>
			</tr>
			";
		$rnd = "SELECT GameRound.RoundID FROM GameRound
			WHERE GameRound.GameID = ".$gid."
			ORDER BY RoundID DESC
			LIMIT 1";
		$rnd = mysql_query($rnd);
		if($rnd===false)
			echo mysql_error();
		
		//saving last 2 words
		
		while($row = mysql_fetch_assoc($rnd))
			$rid = $row['RoundID'];
			
		}
		echo'</table>';
		
		if (strtolower($user1word) == strtolower($user2word))
		{
			echo "Congratulations! You Win!";
		}
		else if($user1word == NULL || $user2word == NULL)
		{
			echo "Please be patient, some players are slower than others. Don't be a dipshit."; // kind and inclusive langauge allows children to learn valuable life lessons in patience and good sportsmanship
		}
		
		else
		{
		
			?>
			
			<form method="GET">
				<input type="text" placeholder="Say The Same Thing Here!" name="word" />
				<button type="submit">SUBMIT</button>
				<input type="hidden" name="game" value="<?php  echo $gid ?>"/>
				<input type="hidden" name="round" value="<?php  echo $rid ?>"/>
			</form>
			
			
			<?php
		}
		
	}
	else
	{
		?>
        
        <h2>Chose Game:</h2>
		<br/>
        
        <?php
		
		$fl = 'SELECT Users.User, Friends.ID
			FROM Users
			JOIN Friends ON Friends.User1 = Users.ID OR Friends.User2 = Users.ID
			WHERE (Friends.User1 = 1 OR Friends.User2 = 1)
			AND Users.ID != 1
		';
		
		$fr = mysql_query($fl);
		
		if($fr===false)
			echo mysql_error();
		else
		{
			while($row = mysql_fetch_assoc($fr))
			{
					echo $row['User'].'<br/>';
					$frid = $row['ID'];//show profile pic here, and href link to profile page	
					//echo $frid.'<br/>';
			}
			
			$game = 'SELECT Game.ID
				FROM Game
				WHERE (Game.FriendsID ='.$frid.')
			';
			
			echo'<table>';
				$results = mysql_query($game);
				
				
				if($results===false)
					echo mysql_error();
				while($row = mysql_fetch_assoc($results))
				{
					echo "
					<tr>
						<td>
							<a href='?game=$row[ID]'> Game!</a>
						</td>
					</tr>
					";	
				}
			echo'</table>';
		
		}	
	}



?>
<div></div>

</div>
</body>

<?php include_once "db_close.php" ?>
</html>