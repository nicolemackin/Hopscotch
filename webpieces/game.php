<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "db_open.php" ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>NETSPACE</title>

<link type="text/css" rel="stylesheet" href="MDMcss.css" />

</head>

<body>
	<!--header!-->
	<img style="position:absolute; left:0%; top:0%; width:100%;" src="images/mdm_01.png"/>
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
    <a href="login.php"><img style="position:absolute; left:87.45%; top: 11.7vw; width:12.5%;" src="images/mdm_08.png"
    				onmouseover="src='images/mdmHov_08.png'"
					onmouseout="src='images/mdm_08.png'"/></a>
	
	<div style="position: absolute; left: 0; right: 0; top: 13vw; text-align: center; font-size:24px; color:#FFF; font-family:'Chalkduster, 'comic sans MS';">Username</div>
    <div style="position: absolute; left: 0; right: 0; top: 17vw; text-align: center; font-size:18px; color:#FF6B6B; font-family:'Short Stack', Chalkduster, 'comic sans MS';">Status</div>
</body>
        
<div id="main" class="gamep" style="top: 20vw; position: absolute;">
        
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
        
        <a href="game.php"/> Return to Start </a>
 </div>
 <div id="game">       
        
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
        </div>
</div>

</body>

<?php include_once "db_close.php" ?>
</html>