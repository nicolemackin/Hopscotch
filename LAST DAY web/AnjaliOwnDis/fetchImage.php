<?php

	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	
	//if(isset($_REQUEST['imageID']))
	//{
		include 'db_open.php';
		
		$sqlImage = "SELECT profilePicName, ppicType FROM Users ";
		//$sqlImage .= "WHERE ID={$_REQUEST['imageID']}";
		$sqlImage .= "WHERE ID=1";
		$resultImage = mysql_query($sqlImage);
		if($resultImage)
		{
			if(mysql_num_rows($resultImage) == 1)
			{
				$rowData = mysql_fetch_assoc($resultImage);
				
				$imgtype = $rowData['ppicType'];
				$imgfile = "images/{$rowData['profilePicName']}";
				$imgbinary = fread(fopen($imgfile, "r"), filesize($imgfile));
				
				echo "<img src='data:image/$imgtype;base64," . base64_encode($imgbinary) . "'/>";
				
				//echo "<br/><center>{$rowData['ImageTitle']}</center><br/>\n";
			}
		}
		
		include 'db_close.php';
	//}

?>