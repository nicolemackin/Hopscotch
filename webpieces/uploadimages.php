<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php

	include "db_open.php";

	if(isset($_FILES['imageFile']['name'])){
		$uploaddir = getcwd(). "/images/";
		$uploadfile = basename($_FILES['imageFile']['name']);
		$uploadpath = $uploaddir . $uploadfile;
		
		if((strcasecmp(substr($uploadfile, -3, 3), "jpg") == 0) || (strcasecmp(substr($uploadfile, -3, 3), "png") == 0) || (strcasecmp($type, "gif") == 0))
		{
			if(!is_file($uploadpath))
			{
				if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadpath))
				{
					$imgData = getimagesize($uploadpath); $type = $imgData['mime'];
					if((strcasecmp($type, "image/jpeg") == 0) || (strcasecmp($type, "image/png") == 0) || (strcasecmp($type, "image/gif") == 0))
					{
						echo "File of a valid type ($type), and was stored as $uploadfile<br/>\n";
						$width = $imgData[0]; $height = $imgData[1];
						$sqlImg = "INSERT INTO Users (profilePicName, ppicWidth, ppicHeight, ppicType) ";
						$sqlImg .= "VALUES ('$uploadfile', '$width', '$height', '$type')";
						$resultImg = mysql_query($sqlImg);
						
						if($resultImg)
						{
							if(mysql_affected_rows() == 1)
								echo "Image data inserted into Database, with ID = ", mysql_insert_id();
						}
					}
					else	{
						echo "Failed mime-checking <br/>"; unlink($uploadpath);
					}
				}
				else
					echo "Upload Error, please try again! <br />\n";
			}
			else
				echo "File already exists <br/>\n";
		}
		else
			echo "Only JPEG, PNG, or GIF images are acceptable ($uploadfile) <br/>\n";
	}

	include "db_close.php";
?>
<center>
<div>
	<form enctype="multipart/form-data" action="uploadimages.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="800000" />
    <table>
    	<tr>
        	<td width="100px">Image:</td>
            <td><input name="imageFile" type="file" /></td>
        </tr>
      	<tr>
        	<td width="100px">&nbsp;</td>
            <td align="right"><input type="submit" value="Upload" /></td>
        </tr>
    </table>
    </form>
</div>
</center>

</body>
</html>