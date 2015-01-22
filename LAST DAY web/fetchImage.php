	<div id="profilePic">
	<?php
			include 'db_open.php';
			
				if (isset($_GET['id']))
				{
						$userid = isset($_GET['id']);
				}
				else{
						$userid = $_SESSION['userid'];
				}
			
				$sql = "SELECT profilepicName 
						FROM Users
						WHERE ID = '$userid'";
						
				$picselect = mysql_query($sql);
				$pic = mysql_fetch_assoc($picselect);
					
				if($pic['profilepicName'] == NULL)
				{
					$pic = " <img src='defaulticon.png' /> ";
					echo $pic;
				}
				else
				{
					$sqlImage = "SELECT profilePicName, ppicType FROM Users ";
					$sqlImage .= "WHERE Users.ID= $userid";
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
						}
					}
				}
	?>
	</div>