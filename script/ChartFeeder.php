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
	 
	 $RequestType = getParam("ChartType");
	 
	 if($RequestType == 'Apppopularity' )
	 {
		GetAppPopularity();
	 }else if($RequestType == 'SitePopularity' )
	 {
		GetSitePopularity();
	 }else if($RequestType == 'TotalApps' )
	 {
		GetTotalApps();
	 }else if($RequestType == 'TotalSites' )
	 {
		GetTotalSites();
	 } else if ($RequestType == 'AllData' )
	 {
		GetAllData();
	 }else ReturnError("Fail", "Invalid Chart Type");

 
mysql_close($con); // Close the sql connection.

function ReturnError( $Status, $ErrorMsg)
{
	echo('{"Staus": '. $Status .', "Message":'. $ErrorMsg .'}');
}

function GetAllData()
{
	echo('{"Staus": "Fail", "Message":" Function Not yet implemented"}');
}

function GetTotalSites()
{
	$sql = "SELECT COUNT(*) AS `count`, `site` FROM `application` GROUP BY `site` ORDER BY `site`";	
	
	$result = mysql_query($sql);
	$rowCount = 0;

	  echo '[';
	  while ($row = mysql_fetch_array($result)) {
			if( $rowCount > 0 )
				echo ',' ;
		  echo '{"count" : ' . json_encode($row['count']) 
					. ', "site" : ' . json_encode($row['site']) 
					. '}';
		  $rowCount = $rowCount + 1;
	  }
	echo ']';
}

function GetTotalApps()
{
	$sql = "SELECT COUNT(*) AS `count`, `name` FROM `application` GROUP BY `name` ORDER BY `name`";	
	
	$result = mysql_query($sql);
	
	if (!$result) {
		die('Could not query:' . mysql_error());
	}
	
	$rowCount = 0;
	
	  echo '[';
	  while ($row = mysql_fetch_array($result)) {
			if( $rowCount > 0 )
				echo ',' ;
		  echo '{"count" : ' . json_encode($row['count']) 
					. ', "application" : ' . json_encode($row['name']) 
					. '}';
		  $rowCount = $rowCount + 1;
	  }
	echo ']';
}

function GetSitePopularity()
{
	$sql = "SELECT COUNT(*) AS `Rows`, `site` FROM `application` GROUP BY `site` ORDER BY `site` ";	
	
	$result = mysql_query($sql);
	$rowCount = 0;

	  echo '[';
	  echo '["Apps", "Clicks", "Views"]';
	  while ($row = mysql_fetch_array($result)) {
			// Retrieve click count for this app
			$CCounts =  getCountforSite( 'application', $row['site'] ,  'click');

			// Retrieve views count for this app
			$VCounts = getCountforSite( 'application', $row['site'] ,  'view');

		  echo ',[' . json_encode( $row['site'] )
					. ', ' . $CCounts
					. ', ' . $VCounts
					. ']';

		$rowCount = $rowCount + 1;
	  }
	echo ']';
}

function getCountforSite($table, $site_name, $action)
{
	if(!$table || !$site_name || !$action ) return 0;
	
	$sql_count = "SELECT Count(*) AS count FROM `". $table ."` where site = '"
				. $site_name ."' and action ='".$action."'";
	
	$ViewCount = mysql_query($sql_count);
	
	if (!$ViewCount) {
		die('Could not query:' . mysql_error());
	}
	return mysql_result($ViewCount, 0);
}
	 
function GetAppPopularity(  )
{
	$sql = "SELECT COUNT( * ) AS `campaigns` , `application` \n"
    . "FROM `campaign` \n"
    . "GROUP BY `application` \n"
    . "ORDER BY `application` \n"
    . "";
	
	$result = mysql_query($sql);
	$rowCount = 0;

	  echo '[';
	  echo '["Apps", "Clicks", "Views"]';
	  while ($row = mysql_fetch_array($result)) {
			// Retrieve views count for this app
			$VCounts = getCountfor( 'application', $row['application'] ,  'view');

			// Retrieve click count for this app
			$CCounts =  getCountfor( 'application', $row['application'] ,  'click');

		  echo ',[' . json_encode( $row['application'] )
					. ', ' . $CCounts
					. ', ' . $VCounts
					. ']';

		$rowCount = $rowCount + 1;
	  }
	echo ']';
}  

function getCountfor($table, $app_name, $action)
{
	if(!$table || !$app_name || !$action ) return 0;
	
	$sql_count = "SELECT Count(*) AS count FROM `". $table ."` where name = '"
				. $app_name ."' and action ='".$action."'";
	
	$ViewCount = mysql_query($sql_count);
	
	if (!$ViewCount) {
		die('Could not query:' . mysql_error());
	}
	return mysql_result($ViewCount, 0);
}

function getParam($key)
{
	return stripslashes($_GET[$key].'');
}

function getPost($key)
{
    return stripslashes($_POST[$key].'');
}
     
?>

