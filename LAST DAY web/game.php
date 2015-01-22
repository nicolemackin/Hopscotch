<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "db_open.php" ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Hopscotch - Games</title>

<?php

//game.php
	//Worked on by: Nicole Mackin, Sara Cavasotto
	//Goal: Create a fun co-opperative game. Game consists of two players attempting to say the same word, and is done via finding the user's friends, finding any games between the friends, and allowing the user to guess words which are then run through a string compare.
	//Includes: game componants
	//Notes: as it is run via a set if if statements, the first step is at the bottom of the page, and works its way back up as more componants are kept

?>
<link type="text/css" rel="stylesheet" href="MDMcss.css" />

</head>

<body>
	<?php include "layout.php";?>
    
   
        
<div id="main" class="gamep" style="top: 20vw; position: absolute;">
        
        <!-- game rules and how to's-->
        <h1 id="gametitle">Say The Same Thing</h1>
        <br/>
<div id="howto">
           
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
            
        <!-- returns back to main game page, useful for when wanting to play with multiple friends-->
        
        <a href="game.php"/> Return to Start </a>
 </div>
 <div id="game">       
        
        <?php
        
        $me = $_SESSION['userid']; //gets user id from session
		
		//COMMMOM CODE (used more than twice throughout in the EXACT same way)
        if(isset($_GET['game']))//SETS $itsme VARIABLE
		{
			$gid = $_GET['game'];
			
			$friend = "
					SELECT Friends.User1, Friends.User2
					FROM Friends
					JOIN Game ON Game.FriendsID = Friends.ID
					WHERE Game.ID = $gid
					"; //determines friendship id
					
					$friend = mysql_query($friend);
					if($friend===false)
						echo mysql_error();
						
					$myid = mysql_fetch_assoc($friend);
					
					if($myid['User1'] == $_SESSION['userid']) // compares to see if my id is the first or second, as games are entered in the same order as friendships, in order to maintain simplicity
						$itsme = 1; //if user 1 is me
					else
                    	$itsme = 2;// if user 2 is me
		}
		//var_dump($itsme); //testing $itsme
        
		
		//////////////////////////////////////////////////////////
		
		
            if( isset($_GET['word']) && (isset($_GET['round'])) ) // runs if word has been submitted and round has been found (thus last stage of game)
            {
               include_once "points.php";//gives points for browsing
			   
			   $gid = $_GET['game'];//gets game id
                $rid = $_GET['round'];//gets round id
                $word = $_GET['word'];//gets word submitted
				
                if($itsme == 1)
                    $itsme = "User1Word"; //word is placed in corelation of friendship panel, aka, if you are the first user in a friendship relation, you have the first word space
                else
                    $itsme = "User2Word";// if you are the second user, your word is in the second space, thus avoiding conflict
                
                $findround ="
                SELECT COUNT(*)
                FROM GameRound
                WHERE GameRound.GameID = $gid
				AND GameRound.RoundID = $rid
				AND GameRound.$itsme IS NULL
                ";// searches all rounds to see if a round of this id already exists
                
                $findround = mysql_query($findround); // inserts into appropriate round
                
				
                if($findround===false)
                    echo mysql_error();
                
                $row = mysql_fetch_row($findround);
                $rows = $row[0];// finds returned value
                
                    if($rows == '1')
                        { // Round does exists
                            
                            $saveword = "
                                UPDATE GameRound
                                SET $itsme = '$word'
                                WHERE GameRound.GameID = ".$gid."
                                AND GameRound.RoundID = ".$rid 
                                ; // inserts into appropriate game
                        }
                        else//if no round of id exists
                        {
                            $rid +=1;
							$saveword = "
                            INSERT INTO GameRound(RoundID, $itsme, GameID) VALUES($rid, '$word', $gid)
                            ";//creates new round
                        }
                
                        $saveword = mysql_query($saveword); //insert word into GameRound table under User1Word or User2Word
                
                            if($saveword===false)
                                echo mysql_error();
                
            
                
            }
            else if(isset($_GET['game']))// if game has been picked, but word has not been played
            {
                include_once "points.php";//gives points for browsing
				
				$gid = $_GET['game'];//gets game id
				
				$friend = "
                SELECT Users.User
                FROM Users
                JOIN Friends ON (Friends.User1 = Users.ID OR Friends.User2 = Users.ID)
                JOIN Game ON Game.FriendsID = Friends.ID
                WHERE Users.ID != $me
				AND Game.ID = $gid
				"; // shows friends name
                $friendname = mysql_query($friend);
                $name = mysql_fetch_assoc($friendname);
                
                if($name===false)
                    echo mysql_error();
                
                ?>
                
                <h2>Game with <?php echo $name['User'];//echo's friends name ?></h2>
                <br/>
                
                <?php
				
                $round = "SELECT GameRound.User1Word, GameRound.User2Word, GameRound.RoundID
                        FROM GameRound
                        WHERE GameRound.GameID = '.$gid.'
                        ORDER BY GameRound.RoundID
                ";//gets all rounds played under game id
                
                
                echo"<table class='wordlist'>";//creates table
                $round = mysql_query($round);
                
                if($round===false)
                    echo mysql_error();
                
                while($row = mysql_fetch_assoc($round))
                {
                   if($itsme == 1)
				   {
					   $myword = $row['User1Word'];//displays words in table
					   $theirword = $row['User2Word'];
				   }	
					else
					{
                   	 	$myword = $row['User2Word'];
					 	$theirword = $row['User1Word'];
					}
					
					if($myword == NULL)
						$theirword ='WORD PLAYED!';
					
                    echo "
                    <tr>
                        <td>
                            <b>Round $row[RoundID]</b>
                        </td>
                        <td>
                            $myword
                        </td>
                        <td>
                            $theirword
                        </td>
                    </tr>
                    ";//displays by round
					
				}
                echo'</table>';// ends table
                
				$rnd = "SELECT GameRound.RoundID FROM GameRound
						WHERE GameRound.GameID = ".$gid."
						ORDER BY RoundID DESC
						LIMIT 1";
					$rnd = mysql_query($rnd);
					if($rnd===false)
						echo mysql_error();
					
					//saving last 2 words
					
					$row = mysql_fetch_assoc($rnd);
					if ($row)
						$rid = $row['RoundID'];
					else
						$rid = 0;
				
				if($itsme == 1)
				   {
					   $myword = $row['User1Word'];//displays words in table
					   $theirword = $row['User2Word'];
				   }	
					else
					{
                   	 	$myword = $row['User2Word'];
					 	$theirword = $row['User1Word'];
					}
				
				if(!isset($user1word))//if no variables exist, no rounds have been played
				{
					$user1word = "A";//set as different values in order to skip the first two statements
					$user2word = "B";// skips comparission of words (winning) and lack of words (not playable)
																								 
				}
				
                if (strtolower($user1word) == strtolower($user2word))//brings down to lowercase and compares. if the same
                {
                    echo "Congratulations! You Win!";
                }
                else if($user1word == NULL || $user2word == NULL)// if only one word played
                {
					if(($itsme == 1 && $user1word == NULL) || ($itsme == 2 && $user2word == NULL) ) // if my user id coresponds to the empty word space, allow my user to play a word
					{	
                    ?>
                    
                    <form method="GET">
                        <input type="text" placeholder="Say The Same Thing Here!" name="word" />
                        <button type="submit">SUBMIT</button>
                        <input type="hidden" name="game" value="<?php echo $gid ?>"/>
                        <input type="hidden" name="round" value="<?php echo $rid ?>"/>
                    </form>
                    <!-- allows user to input a word to the game -->
                    
                    <?php
					}
					else
						echo "Waiting for round to be completed..."; // in place of text box, places message so that rounds arent created ahead of time
                }
                
                else
                {
                
                    ?>
                    
                    <form method="GET">
                        <input type="text" placeholder="Say The Same Thing Here!" name="word" />
                        <button type="submit">SUBMIT</button>
                        <input type="hidden" name="game" value="<?php echo $gid ?>"/>
                        <input type="hidden" name="round" value="<?php echo $rid ?>"/>
                    </form>
                    <!-- allows user to input a word to the game -->
                    
                    <?php
                }
                
            }
            else
            {
                ?>
                
                <h2>Chose Game:</h2>
                <br/>
                
                <?php
				include_once "points.php";//gives points for browsing
                //allows user to find a game being played with their friends
                $fl = "SELECT Users.User, Friends.ID
                    FROM Users
                    JOIN Friends ON Friends.User1 = Users.ID OR Friends.User2 = Users.ID
                    WHERE (Friends.User1 = $me OR Friends.User2 = $me)
                    AND Users.ID != $me";
					
                $fr = mysql_query($fl);
                
                if($fr===false)
                    echo mysql_error();
                else
                {
                    while($user = mysql_fetch_assoc($fr))
                    {
                            $name = $user['User'].'<br/>'; //lists off friends
                            $frid = $user['ID'];//collects friends' id
							
							$ifgame = "SELECT COUNT(*)
										FROM Game
										WHERE (Game.FriendsID = $frid)";//counts number of games with friend
							$ifgame = mysql_query($ifgame);
							if($ifgame===false)
                            	echo mysql_error();
								
								while($row = mysql_fetch_array($ifgame))
								{
									//var_dump($row);
									if($row[0] > 0)
									{
										$game = 'SELECT Game.ID, Game.FriendsID
                        						FROM Game
                       							WHERE (Game.FriendsID ='.$frid.')
                    							';//selects games with this player
												
										echo'<table>';
										$results = mysql_query($game);//displays results
							
							
										if($results===false)
											echo mysql_error();
										else
										{
											while($res = mysql_fetch_assoc($results))
											{
											   if($res['ID']!= NULL && $res['FriendsID'] != NULL) // if there is a friend id and a game id
											   {
											   echo "
												<tr>
													<td>
														<a href='?game=$res[ID]'> Game with $name</a>
													</td>
												</tr>
												";
											   }
											}
										} 
									}// end of if count > 0
									else // if count = 0
									{
										 echo "<td>";
										 echo "Create game with $name ? ";
							 			 ?>
                                        <form method='POST' action='newgame.php'>
                                        <button TYPE='submit'>CREATE</button>
                                        <input type="hidden" name="frid" value="<?php echo $frid;?>"/>
                                        <input type="hidden" name="name" value="<?php echo $name;?>"/>
                                        </form>
                                        <!-- Sends game id to function create game, then to file newgame.php  -->
                                        <?php
										echo "</td>";
									}   
                       	 }
                    echo'</table>';
					}
                
                }
			}
        
        ?>
        </div>
</div>

</body>

<?php include_once "db_close.php"; ?>
</html>