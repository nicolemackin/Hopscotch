<?php
include 'db_open.php';

session_start();

				$query = mysql_query('SELECT * FROM WallPosts');
                if(!$query)	echo "<br/> ERROR: " . mysql_error() . "<br/>";
                    
               
               if (mysql_num_rows($query) > 0)
                    {
                        
                     
                        while($row=mysql_fetch_array($query))
                        {
                           
                            echo "<div style='font-size:9pt;'>";
                            $query2 = mysql_query('SELECT * FROM Comments WHERE post = "'.$row['ID'].'"');
                            if(!$query2)	echo "<br/> ERROR: " . mysql_error() . "<br/>";
                                
                            if(mysql_num_rows($query2) == 0)
                            {
                                echo "Be The First to leave a comment!";
                            }
                            else if (mysql_num_rows($query2) > 0)
                            {
                                while($row2=mysql_fetch_array($query2))
                                {	
                                    echo "<br/>ID: " . $row2['ID'] . "<br/>Message: " . $row2['Comment'] . "<br/>Time: " . $row2['Time'] . "<br/>";				
                                }
                                    
                            }
                                
                            echo '
                                <form method="post">
                                Leave A Comment! <textarea name="comment" rows="3" cols="20" ></textarea>
                                <input type="submit" value="Submit"/>
                                <input type="hidden" name="postPimp" value="'.$row['ID'].'" />
                                </form>
                            ';	  
                            echo "</div>";
                    
                        }		
                        
                    }
include 'db_close.php';
?>