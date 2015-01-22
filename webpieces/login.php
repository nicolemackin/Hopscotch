<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login/Create an Account</title>
</head>

<body>

<div id="login"><h1>Login</h1>

<table>
	<form method="POST" Action="login.php">
    <table border="1">
	<tr>
    	<td> Username: </td>
    </tr>
    <tr>
    	<td> <input TYPE="TEXT" NAME="User" SIZE="70"/></td>
    </tr>
    <tr>
    	<td>Password:</td>
    </tr>
    <tr>
    	<td><input TYPE="password" NAME="Passwd" SIZE="40"/></td>
    </tr>

</table>
<p><input TYPE="SUBMIT" VALUE="Submit" Name="login"/></p>
</form>


</div>

<div id="create">
<h1>Create Account</h1>

<table>
	<form method="POST" Action="login.php">
    <table border="1">
	<tr>
    	<td> Desired Username: </td>
    </tr>
    <tr>
    	<td> <input TYPE="TEXT" NAME="User" SIZE="40"/></td>
    </tr>
    <tr>
    	<td>Password:</td>
    </tr>
    <tr>
    	<td><input TYPE="password" NAME="Passwd" SIZE="40"/></td>
    </tr>
    <tr>
    	<td>Retype Password:</td>
    </tr>
    <tr>
    	<td><input TYPE="password" NAME="Passwd" SIZE="40"/></td>
    </tr>
    <tr>
    	<td>Parent's Email:</td>
    </tr>
    <tr>
    	<td><input TYPE="TEXT" NAME="email" SIZE="70"/></td>
    </tr>
    <tr>
    	<td>Birthday:</td>
    </tr>
     <tr>
    	<td><input TYPE="DATE" NAME="birthday"/></td>
    </tr>
     <tr>
    	<td>Favourite Song:</td>
    </tr>
     <tr>
    	<td>EMBEDDING CODE PLACED HERE? LINK TO VIDEO PERHAPS</td>
    </tr>
     <tr>
    	<td>Profile Picture:</td>
    </tr>
     <tr>
    	<td>Photo upload code HERE</td>
    </tr>
     <tr>
    	<td>Tell us about you! (this will be displayed bublically on your prifile page!):</td>
    </tr>
     <tr>
    	<td><input TYPE="TEXT" NAME="about" SIZE="70"/></td>
    </tr>
     <tr>
    	<td>What is your dream?  (this will be displayed bublically on your prifile page!):</td>
    </tr>
     <tr>
    	<td><input TYPE="TEXT" NAME="dream" SIZE="70"/></td>
    </tr>

</table>
<p><input TYPE="SUBMIT" VALUE="Submit" Name="login"/></p>
</form>


</div>
</body>
</html>