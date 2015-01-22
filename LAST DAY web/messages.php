<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "db_open.php" ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Hopscotch - Messages</title>

<link type="text/css" rel="stylesheet" href="MDMcss.css" />

<script>

////////////////////////////////////////////////////////////////////////////////////////////

fetchInbox();
setInterval ( "fetchInbox()", 100 );

function fetchInbox()
{
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("get", "fetchMessages.php", true);
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4) 
		{
			if(xmlHttp.status == 200)
			{ displayInbox(xmlHttp.responseText); } 
			else
			{ alert("Oh no, an error occured"); }
		}
	};
	
	xmlHttp.send(null);
}

////////////////////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////////////

function displayInbox(sInbox)
{
	var divInbox = document.getElementById("messages");
	divInbox.innerHTML = sInbox;
}


function uploadMsg()
{
	var MsgData = "uMsg="+document.getElementById("message").value;
	
	document.getElementById("message").value = '';
	
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("post", "uploadMsg.php", true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", MsgData.length);
	xmlHttp.setRequestHeader("Connection", "close");
	
	xmlHttp.onreadystatechange = function () 
	{
		if(xmlHttp.readyState == 4) 
		{
			if(xmlHttp.status == 200) 
				{/*alert("Message Posted");*/}
			else
				alert("could not upload message");
		}
	};
	xmlHttp.send(MsgData);
	
}

////////////////////////////////////////////////////////////////////////////////////////////


</script>

<?php session_start(); ?>

</head>

<body>
<?php include "layout.php"?>

<div id="main" style="top: 20vw; position: absolute; left:0; right:0; width:100%;">
        
        <?php
	
	$_SESSION['UserID'] = $me =  $_SESSION['userid']; //for now, lets assume we are always the first user, aka, mdmTest1. 
	//This number will be changed to a different one selected by cookie once we get the basic functions of the website working, and a login system established
	//mdmTest 1 wants to talk to their friend, mdmTest2
	// to find mdmTest2, we want to assume mdmTest1 has more friends, and try to make our code very general, where it fills in itself
	
	$id;	//friend ID
	$name;	//friend name
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
		   <form action="messages.php" method='post'>
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
					$_SESSION['FriendID'] = $id;		
					?>
	        	 	</select>
           		 	&nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
        			<input type='text' id='message' maxlength='255'/>
                    <input type='submit' name='msg' value='Send' onClick ='uploadMsg()'/>
                        		    
		   </form>
           
       	 </div>
         
        	 <?php

//////////////////////////////////////////////////////////////////////////////////////////////
//				//Moved into the paragraph so that it displays in the <div>
//				if($inbox != NULL)
//				while($row = mysql_fetch_assoc($inbox)) 
//				{
//						//Since we have no test message, we output nothing	
//					
//				
//					$msg = $row['Message']; //saves message
//					$sender = $row['sender']; //saves friends name
//					$receiver = $row['receiver']; //saves receiver
//					$msgid = $row['ID']; //saves message id
//					$msgtime = $row['Time']; //saves receiver
//					
//					
//					echo "
//						<tr>
//							<td>
//								<b>Message from: $sender</b>
//								<b>Message to: $receiver</b>
//							</td>
//							<td>
//								<p> $msgid </p>
//							</td>
//							<td>
//								<b>Sent at $Time </b>
//							</td>
//						</tr>
//						";
//				}
//				echo'</table>';
//				
//////////////////////////////////////////////////////////////////////////////////////////////

				// Following code uploads messages
				
//				$UserID = $me; //This is the ID of the user, could just use the $me variable
//				if (isset($_POST['msg']))
//				{
//
//					$message = $_POST['message']; //Get the message
//
//					$UserID = $_POST['UserID']; //Get the UserID
//
//					$Upload = "
//					INSERT INTO Messages (sender, Message, receiver) 
//					VALUES ($UserID, '$message', $id)"; //Upload the message, senderID and receiverID
//
//					$resUpload = mysql_query($Upload);
//					if($resUpload == false) //Check to see if Message has bee delivered
//						echo "Could not deliver message <br/>";
//					echo $message; //Display message, may be removed later
//
//				}
				
////////////////////////////////////////////////////////////////////////////////////////////
				
			?>
            
            </p>
       	 
  </div>
  
  <div id="messages" style="height:600px; background-color:#6C7C8E; overflow:auto;"></div>
</div>
</body>

<?php include_once "db_close.php" ?>
</html>