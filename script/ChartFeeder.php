<?php
/*
 * Created on Sep 2, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

 $username = "testUset";
 $password = "test";
 $database = "appreporting";
 
	$con = mysql_connect("localhost","puzzleAdmin", "test");
	@mysql_select_db($database, $con) or die("Unable to select database");
	 
	$sql = "SELECT COUNT( * ) AS `campaigns` , `application` \n"
		. "FROM `campaign` \n"
		. "GROUP BY `application` \n"
		. "ORDER BY `application` \n"
		. "LIMIT 0 , 30\n"
		. "";
		
	$result = mysql_query($sql);
	$rowCount = 0;

	  echo '[';
	  while ($row = mysql_fetch_array($result)) {
			if( $rowCount > 0 )
				echo ',' ;
		  echo '{"campaigns" : ' . json_encode($row['campaigns']) 
					. ', "application" : ' . json_encode($row['application']) 
					. '}';
		  $rowCount = $rowCount + 1;
	  }
	echo ']';
     
      
mysql_close($con); // Close the sql connection.
//phpinfo();
      
?>

