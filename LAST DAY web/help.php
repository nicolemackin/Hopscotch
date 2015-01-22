<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "db_open.php" ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Hopscotch - Help</title>

<link type="text/css" rel="stylesheet" href="MDMcss.css" />

</head>

<body>

    <?php include "layout.php"; ?> 
    <?php session_start(); ?>       
        <div id="main" style="top: 20vw; position: absolute; text-align:center; left:0; right:0;">
        
        <h1> HELP </h1>
		<ul>
        	<li><a href="home.php">This is your personal home page!</a></li>
        </ul>	
    	</div>

</body>

<?php include_once "db_close.php" ?>
</html>