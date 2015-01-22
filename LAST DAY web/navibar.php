<?php include_once "db_open.php" ?>
<link type="text/css" rel="stylesheet" href="MDMcss.css" />

	<?php // Detects if the user is currently logged in and changes the menu accordingly, as well as providing the login if they aren't
	session_start(); //Required at the beginning of all pages that check if you're logged in (Almost all pages in our case).
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true') { //If the user is logged in, do this. 
	
	include "layout.php";
	?>
	
	<?php }
	else { //If the user is not logged in, do this. ?>
    
	<!--header!-->
	<img style="position:absolute; left:0%; top:0%; width:100%;" src="images/mdm_01.png"/>
    <!-- buttons! -->
	<!-- messages -->
    <img style="position:absolute; left:0%; top: 11.7vw; width:12.6%;" src="images/mdm_02.png"
    				onmouseover="src='images/mdmHov_02.png'"
					onmouseout="src='images/mdm_02.png'"/>
	<!-- friends -->
    <img style="position:absolute; left:12.6%; top: 11.7vw; width:12.6%;" src="images/mdm_03.png"
    				onmouseover="src='images/mdmHov_03.png'"
					onmouseout="src='images/mdm_03.png'"/>
	<!-- games -->
    <img style="position:absolute; left:25.2%; top: 11.7vw; width:15.1%;" src="images/mdm_04.png"
   					onmouseover="src='images/mdmHov_04.png'"
					onmouseout="src='images/mdm_04.png'"/>
	<!-- events -->
    <img style="position:absolute; left:59.75%; top: 11.7vw; width:15.0%;" src="images/mdm_06.png"
    				onmouseover="src='images/mdmHov_06.png'"
					onmouseout="src='images/mdm_06.png'"/>
	<!-- help-->
    <img style="position:absolute; left:74.75%; top: 11.7vw; width:12.7%;" src="images/mdm_07.png"
    				onmouseover="src='images/mdmHov_07.png'"
					onmouseout="src='images/mdm_07.png'"/>
	<!-- logout -->
    <img style="position:absolute; left:87.45%; top: 11.7vw; width:12.5%;" src="images/mdm_08.png"
    				onmouseover="src='images/mdmHov_08.png'"
					onmouseout="src='images/mdm_08.png'"/>
    	<div style="position: absolute; left: 0; right: 0; top: 13vw; text-align: center; font-size:24px; color:#FFF; font-family:'Chalkduster, 'comic sans MS';">Welcome</div>
    <div style="position: absolute; left: 0; right: 0; top: 17vw; text-align: center; font-size:18px; color:#FF6B6B; font-family:'Short Stack', Chalkduster, 'comic sans MS';">to Hopscotch</div>
				<div id="main" style="top: 20vw; position: absolute; text-align:center;">
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
									header("Location: home.php");
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
        </div>	
	<?php }
	?>
	</div> <!-- End of the Header Div -->

