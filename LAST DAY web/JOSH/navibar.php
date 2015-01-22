<?php include_once "db_open.php" ?>
<link type="text/css" rel="stylesheet" href="MDMcss.css" />
<div class="header" > <!-- Header div contains the entire header, including logo and navigation -->
	<div id="logobar" class="header">
		<img src="logoplaceholder.png" id="logo"> <!-- This is the logo image for the website -->
	</div>
	<?php // Detects if the user is currently logged in and changes the menu accordingly, as well as providing the login if they aren't
	session_start(); //Required at the beginning of all pages that check if you're logged in (Almost all pages in our case).
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true') { //If the user is logged in, do this. ?>
		<div id="links">
			<div id="c123"> <!-- Div for the first three navigation buttons -->
				<a href="index.php"> <img src="navImgs/homeNorm.png" id="c2" 
				onmouseover="this.src='navImgs/homePress.jpg'" 
				onmouseout="this.src='navImgs/homeNorm.png'"></a> 					<!-- HOME -->
				
				<a href="messages.php"> <img src="navImgs/messagesNorm.png" id="c3"
				onmouseover="this.src='navImgs/messagesPress.jpg'" 
				onmouseout="this.src='navImgs/messagesNorm.png'"></a> 				<!-- MESSAGES -->
				
				<a href="game.php"> <img src="navImgs/gameNorm.png" id="c1"			 
				onmouseover="this.src='navImgs/gamePress.jpg'" 
				onmouseout="this.src='navImgs/gameNorm.png'"> </a> 					<!-- GAMES -->
			</div> <!-- End of the first three navigation buttons -->
		
			<div id="identity"> <!-- Div for the logged in user's information or the means for the user to log in -->
			<div id="c123">
				<h id="name"> YOUR NAME </h> </br> <!-- PLACEHOLDER Will hold a value for $_SESSION['username'] -->
				<h id="status" > STATUS </h>	   <!-- PLACEHOLDER Will hold a balue for $_SESSION['status']   -->
			</div>
			</div> <!-- End of the user identity div -->
   
			<div id="c123"> <!-- Div for the last three navigation buttons -->
				<a href="friends.php"> <img src="navImgs/friendsNorm.png" id="c5" 
				onmouseover="this.src='navImgs/friendsPress.jpg'" 
				onmouseout="this.src='navImgs/friendsNorm.png'"> </a> 				<!-- FRIENDS -->
				
				<a href="events.php"> <img src="navImgs/eventsNorm.png" id="c4" 
				onmouseover="this.src='navImgs/eventsPress.jpg'" 
				onmouseout="this.src='navImgs/eventsNorm.png'"> </a> 				<!-- EVENTS -->
				
				<a href="help.php"> <img src="navImgs/helpNorm.png" id="c6" 
				onmouseover="this.src='navImgs/helpPress.jpg'" 
				onmouseout="this.src='navImgs/helpNorm.png'"></a> 					<!-- HELP -->
			</div> <!-- End of the last three navigation buttons -->
	  

		</div> <!-- End of the navigation div -->
	
	<?php }
	else { //If the user is not logged in, do this. ?>
		<div id="links">
			<div id="c123"> <!-- Div for the first three navigation buttons -->
				<a href="index.php"> <img src="navImgs/homeNorm.png" id="c1" 
				onmouseover="this.src='navImgs/homePress.jpg'" 
				onmouseout="this.src='navImgs/homeNorm.png'"></a> 								<!-- HOME -->
				
				<a href="messages.php"> <img src="navImgs/restrictedNorm.png" id="c2"/></a> 	<!-- MESSAGES -->
				
				<a href="game.php"> <img src="navImgs/restrictedNorm.png" id="c3"/></a> 		<!-- GAMES -->
			</div> <!-- End of the first three navigation buttons -->
							
   
			<div id="c456"> <!-- Div for the last three navigation buttons -->
				<a href="friends.php"> <img src="navImgs/restrictedNorm.png" id="c4"/></a> 		<!-- FRIENDS -->
				
				<a href="events.php"> <img src="navImgs/restrictedNorm.png" id="c5"/></a> 		<!-- EVENTS -->
				
				<a href="help.php"> <img src="navImgs/helpNorm.png" id="c6" 
				onmouseover="this.src='navImgs/helpPress.jpg'" 
				onmouseout="this.src='navImgs/helpNorm.png'"></a> 								<!-- HELP -->
			</div> <!-- End of the last three navigation buttons -->
							
			<div id="identity"> <!-- Div for the logged in user's information or the means for the user to log in -->
				<t id="name"> Please log in to access the full website! </t> </br> <!--  -->
				
				<?php
					if(isset($_POST['submit'])){
						$uname = mysql_real_escape_string($_POST['uname']);
						$ptmp = mysql_real_escape_string($_POST['pword']);
						$pword = md5($ptmp);
						
						//echo $uname, " - ", $pword;

					//	$sqlCheck = "SELECT * FROM Users JOIN Passwords ON Passwords.userID=Users.ID";
						$sqlCheck = "SELECT * FROM Users WHERE User = '".$uname. "'";
						$resultCheck = 	mysql_query($sqlCheck);

						if(isset($resultCheck)){
							
							if(mysql_num_rows($resultCheck) == 1){
								
								$rowCheck = mysql_fetch_assoc($resultCheck);
								//$fullname = $rowCheck['NameFull'];
								$ID = $rowCheck['ID'];
								if(isset($ID)){
									// Store Session Variables
									$_SESSION['uname'] = $uname;
									//$_SESSION['fname'] = $fullname;
									$_SESSION['userid'] = $ID;		
									$_SESSION['loggedin'] = 'true';
									// Redirect to myindex.php
									header("Location: index.php");
									}
								else
									echo "ID not set";
							}
							else if(mysql_num_rows($resultCheck) == 0)
								echo "Username/Password don't match";
						}
						else
							echo mysql_error();
						}
					?>
				<div align="center" style="padding:40px;">
					<form action="index.php" method="post">
					<table border="0">
						<tr>
							<td align='left'>Username:</td>
							<td><input type="text" name="uname"/> </td>
							</tr>
						<tr>
							<td align='left'>Password:</td>
							<td><input type="password" name="pword"/></td>
							</tr>
						</table>
					<input type="submit" name="submit" value="Login"/>
					</form>

				<a href="signup.php">Sign me Up!</a>							
			</div> <!-- End of the user identity div --> 	  
		</div> <!-- End of the navigation div -->	
	<?php }
	?>
	</div> <!-- End of the Header Div -->

