<?php
/***
 * This file is responsible to store a new puzzle into the data base.
 * some of the parameters are must to insert a new puzzle into data base.
 * 
 */

 //print_r($_POST);  // for input parameter check.
 
 $PId = getPost('PId');
 $PType = getPost('PType');
 $Catagory = getPost('Catagory');
 $Question = getPost('Question');
 $OptionType = getPost('OptionType');
 $Opt1 = getPost('Opt1');
 $Opt2 = getPost('Opt2');
 $Opt3 = getPost('Opt3');
 $Opt4 = getPost('Opt4');
 $Answer = getPost('Answer');
 $Dificulty = getPost('Dificulty');
 $Weight = getPost('Weight');

 //echo 'PId:' . $PId;
 //echo 'PType' . $PType;
 //echo 'Catagory' . $Catagory;
 //echo 'Question' . $Question;
 //echo 'OptionType' . $OptionType;
 //echo 'Opt1' . $Opt1;
 //echo 'Opt2' . $Opt2;
 //echo 'Opt3' . $Opt3;
 //echo 'Opt4' . $Opt4;
 //echo 'Answer' . $Answer;
 //echo 'Dificulty' . $Dificulty;
 //echo 'Weight' . $Weight;
 
 $username = "testUset";
 $password = "test";
 $database = "puzzledb";
 
$con = mysql_connect("localhost","puzzleAdmin", "test");
if (!$con)
  {
  die('Could not connect to Data base: ' . mysql_error());
  }
  
@mysql_select_db($database, $con) or die("Unable to select database");

//Create Query to insert new puzzle.
 $query = "INSERT INTO puzzle ( PType, Catagory, Question, OptionType, Opt1, Opt2, Opt3, Opt4, Answer, Dificulty, Weight)
VALUES ('$PType','$Catagory', '$Question', '$OptionType', '$Opt1', '$Opt2', '$Opt3', '$Opt4', '$Answer', '$Dificulty', '$Weight')";
//echo "Query is:". $query;

//Ececute Query...
 if (!mysql_query($query,$con))
  {
	//Die if there is an error.
	echo "{'Status': 'Fail;}";
  die('Error: ' . mysql_error());
  }
  
echo "{'Status': 'Success'}";

mysql_close($con);
 
function getPost($key)
{
    return stripslashes($_POST[$key].'');
}
?> 
