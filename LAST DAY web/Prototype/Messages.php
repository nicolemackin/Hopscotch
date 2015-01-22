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
        
        <?php
	
	$me = 1; //for now, lets assume we are always the first user, aka, mdmTest1. 
	//This number will be changed to a different one selected by cookie once we get the basic functions of the website working, and a login system established
	//mdmTest 1 wants to talk to their friend, mdmTest2
	// to find mdmTest2, we want to assume mdmTest1 has more friends, and try to make our code very general, where it fills in itself
	
	$id;	//friend ID
	$name;	//friend name
///////////////////////////////////////////////////////////////////////////////////////////////////////	
	$relationship = "
					SELECT Users.User, Friends.ID
					FROM Users
					JOIN Friends ON Friends.User1 = Users.ID OR Friends.User2 = Users.ID
					WHERE (Friends.User1 = $me OR Friends.User2 = $me)
					AND Users.ID != $me 
					"; 
					
	//Selects pertinent data, aka, friends Username, and the refference to their friendship
	//Users may be the second user (User2) in the friendship relation, so both much be checked
	//The variable $me is used to represent the id code, which is 1, as seen above
		
	$relationship = mysql_query($relationship); //redefined since we aren't using relationship anymore
							   
		if($relationship == false)
			echo mysql_error();//outputs error message
	
	while($row = mysql_fetch_assoc($relationship)) //while this query is open, does the following
			{
					//var_dump($row); --> tests arrays, and shows all possible mixes of the following
				//	echo $row['User'].'<br/>'; // outputs friends username (mdmTest2)
				//	echo $row['ID'];//outputs friendship ID (0)	
					
					//why does it say Query was empty after 0?
					
					$friendID = $row['ID']; //saves friend ID
					$frName = $row['User']; //saves friends name
			}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

	$relationship2 = "	SELECT Users.User, Users.ID
								FROM Users
								JOIN Friends ON Friends.User1 = Users.ID OR Friends.User2 = Users.ID
								WHERE (Friends.User1 = $me OR Friends.User2 = $me)
								AND Users.ID != $me
								";
								
	$relationship2 = mysql_query($relationship2);
	
	//$inbox = mysql_query('
	//					 SELECT * 
	//					 FROM Users 
	//					 INNER JOIN Messages ON Users.ID = Messages.sender 
	//					 INNER JOIN ON Users.ID = Messages.receiver'); //FRED'S CODE
	//really good, just made the order clearer and added info desired from query!
	
////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	$inbox = mysql_query("
						 SELECT Messages.receiver, Messages.sender, Messages.Message, Messages.Time, Messages.ID
						 FROM Users
						 JOIN Users ON Users.ID = Messages.sender
						 JOIN Users ON Users.ID = Messages.receiver
						 ORDER BY Time
						 "); 
	
	echo"<table class='inbox'>"; //creating a table to hold message data before query. usign the class allows for formatting rules to be applied nicely
	
	$inbox = mysql_query($inbox);
	
		if($inbox == false)
			echo mysql_error();//outputs error message

////////////////////////////////////////////////////////////////////////////////////////////////////////
	 
?>
        
        <div id="main">
        
        <p>
        <div>
		   <form action="Messages.php" method='post'>
           			<select id="friends" name="friends">
        		      <option value=" ">Choose a friend</option> 
                      <?php
							
					if($relationship2 == false)
						echo mysql_error();//outputs error message
					 
					while($row = mysql_fetch_assoc($relationship2))
						{
							$id = $row['ID'];
							$name = $row['User'];
							echo "<option value=$id>$name</option>";	
						}
					  ?>
	        	 	</select>
           		 	&nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
        			<input type='text' name='message' maxlength='255'/>
                    <input type='submit' name='msg' value='Send'/>
         	   		<input type='hidden' name='UserID' value='<?php echo $me; ?>'/>
                        		    
		   </form>
           
       	 </div>
         
        	 <?php

////////////////////////////////////////////////////////////////////////////////////////////
				//Moved into the paragraph so that it displays in the <div>
				if($inbox != NULL)
	while($row = mysql_fetch_assoc($inbox)) 
			{
					//Since we have no test message, we output nothing	
				
				
				$msg = $row['Message']; //saves message
				$sender = $row['sender']; //saves friends name
				$receiver = $row['receiver']; //saves receiver
				$msgid = $row['ID']; //saves message id
				$msgtime = $row['Time']; //saves receiver
				
				
				echo "
					<tr>
						<td>
							<b>Message from: $sender</b>
							<b>Message to: $receiver</b>
						</td>
						<td>
							<p> $msgid </p>
						</td>
						<td>
							<b>Sent at $Time </b>
						</td>
					</tr>
					";
			}
			echo'</table>';
				
////////////////////////////////////////////////////////////////////////////////////////////

				// Following code uploads messages
				
				$UserID = $me; //This is the ID of the user, could just use the $me variable
				if (isset($_POST['msg']))
				{
					
					$message = $_POST['message']; //Get the message
					
					$UserID = $_POST['UserID']; //Get the UserID
					
					$Upload = "INSERT INTO Messages (sender, Message, receiver) VALUES ($UserID, '$message', $id)"; //Upload the message, senderID and receiverID
					$resUpload = mysql_query($Upload);
					if($resUpload == false) //Check to see if Message has bee delivered
						echo "Could not deliver message <br/>";
					echo $message; //Display message, may be removed later
				
				}
				
////////////////////////////////////////////////////////////////////////////////////////////
				
			?>
            
            </p>
       	 
  </div>

</body>

<?php include_once "db_close.php" ?>
</html>