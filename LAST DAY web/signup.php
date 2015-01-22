<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign Up</title>
<script language="javascript" src="md5.js"></script>
<script type="text/javascript">

	function checkUsername()
	{
		var sUsername = document.getElementById('userInput');
		var sMsg = document.getElementById('userMsg');
	
		if(sUsername.value.length < 6)
		{
			sMsg.innerHTML = "Username not long enough";
			return;
		}
		
		var oXMLHttp = new XMLHttpRequest();	
		if(oXMLHttp == null) return(null);
				
		var cURL = "checkUsername.php?uname=" + sUsername.value;
		oXMLHttp.open("get", cURL, true);
		
		oXMLHttp.onreadystatechange = function()
		{
			if((oXMLHttp.readyState == 4)&&(oXMLHttp.status == 200))
			{
				if(oXMLHttp.responseText == '0')		sMsg.innerHTML = "Username already taken!";
				else if(oXMLHttp.responseText == '1')	sMsg.innerHTML = "Username available, take it now!";
				else									sMsg.innerHTML = "A checking error cccured";
			}
		};
		
		oXMLHttp.send(null);
	}
	
	function encryptPass(sNum)
	{
		var sPassword = document.getElementById("passInput" + sNum);	
		var sNewPassword = calcMD5(sPassword.value);
		sPassword.value = sNewPassword;

		if(sNum == 2)
		{
			var sMsg = document.getElementById('userMsg');

			if(document.getElementById("passInput1").value != document.getElementById("passInput2").value)
				sMsg.innerHTML = "Passwords do not match!";
			else
				sMsg.innerHTML = "Passwords match :)";
		}
	}

</script>
<?php
	include "db_open.php";
	
	if(isset($_POST['submit']))
	{
		if(strcmp($_POST['pword1'],$_POST['pword2']) == 0)
		{
			$uname = mysql_real_escape_string($_POST['uname']);
			$fname = mysql_real_escape_string($_POST['fname']);
			$pword = mysql_real_escape_string($_POST['pword1']);
			$email = mysql_real_escape_string($_POST['email']);
		
			if((!empty($uname))&&(!empty($pword))&&(!empty($email)))
			{
				$sqlNewUser = "INSERT INTO Users (User, Email, Password) VALUES ('$uname', '$email', '$pword')";
								
				$resultNewUser = mysql_query($sqlNewUser);
							
				if($resultNewUser)
				{
					if(mysql_affected_rows() == 1)	echo "User added successfully";
					else							echo "User not added";
				}
				else
					echo mysql_error();
			}
		}
	}
	
	include "db_close.php";
?>


</head>
<body>

<?php include "layout.php"; ?>


<div id="main"align=" center" style="top: 20vw; position: absolute;">
<h3>Please enter your details below:</h3>
<form action="signup.php" method="post">
<table border="0">
	<tr>
    	<td align='left' width="250px">Requested Username (min. 6 characters):</td>
    	<td><input id="userInput" type="text" name="uname" onkeyup="checkUsername();"/> </td>
	</tr>
	<tr>
    	<td align='left' width="250px">What's your full name?:</td>
    	<td><input id="userFull" type="text" name="fname"/> </td>
	</tr>
	<tr>
    	<td align='left' width="250px">What password would you like to use? (Get a parent to write this down!):</td>
    	<td><input id="passInput1" type="password" name="pword1" onchange="encryptPass(1);"/></td>
	</tr>
	<tr>
    	<td align='left' width="250px">Please type the password again, so that we know it's correct:</td>
    	<td><input id="passInput2" type="password" name="pword2" onchange="encryptPass(2);"/></td>
	</tr>
	<tr>
    	<td align='left' width="250px">Get a parent to type their email address here!:</td>
    	<td><input type="text" name="email"/></td>
	</tr>
</table>
<input type="submit" name="submit" value="Sign Up"/>
</form>
</div>
<br/><br/>
<center>
<div id="userMsg" align="center" style="width:300px; background:#CCC; padding:10px">
Please enter a username and a password...
</div>
<br/><br/>
<a href='index.php'>Back to Login page </a>
</center>
</body>
</html>