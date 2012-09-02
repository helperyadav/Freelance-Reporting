<?php
/*
 * Created on Jan 6, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 //echo 'hello world.';
 $username = "testUset";
 $password = "test";
 $database = "appreporting";
 
 
 
//$con = mysql_connect("localhost","tttt", "tttt");
$con = mysql_connect("localhost","puzzleAdmin", "test");
@mysql_select_db($database, $con) or die("Unable to select database");
 
 
 
 $sql = "SELECT COUNT(*) AS `Rows`, `application` FROM `campaign` GROUP BY `application` ORDER BY `application` LIMIT 0, 30 ";
 
 
 
 
$result = mysql_query("SELECT * FROM application");
echo($result);
echo("Results found <br>"); 
          echo '[';
          while ($row = mysql_fetch_array($result)) {
              echo '{"Name" : ' . json_encode($row['name']) 
              			. ', "Date" : ' . json_encode($row['date']) 
              			. ', "Time" : ' . json_encode($row['time']) 
              			. ',"Action" : ' . json_encode($row['action']) 
              			. ',"Site" : ' . json_encode($row['site']) 
              			. ',"user_id" : ' . json_encode($row['user_id']) 
              			. '}';
          }
      	echo ']';
     
      
mysql_close($con); // Close the sql connection.
//phpinfo();
      
?>
