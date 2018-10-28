#!/usr/bin/php
<?php
//$playerIDs must be an array
$sessionMock = "jonathan";
//playerIDs roster mock
//MIMICING BUILD PAGE MOCK
$players = array("9249", "9411");
//$teamName = $players[0];
//$playersOpp = array("9510", "9509");
buildTeams($players, $sessionMock);
//buildTeams($playersOpp);
//calculateScore($players, $teamName);
// connect to build team page
function buildTeams($playerIDs, $sessionUser)
{
        $servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
	$dbname = "loginDB";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
	$tableName = "team$sessionUser";
	echo $tableName;
	$sql3 = "drop table ".$tableName;
	mysqli_query($conn, $sql3);
	$sql = "CREATE TABLE $tableName(playerID varchar(30), lastName varchar(30), efficiency varchar(30))";	
	mysqli_query($conn, $sql);
	//array_splice($playerIDs, 0, 1);
	foreach($playerIDs as $playerID)
	{
		$playerStats = "select playerID, lastName, efficiency from playerTable where playerID ='$playerID'";
		$result = mysqli_query($conn, $playerStats);
		$row = mysqli_fetch_row($result);
		//var_dump($result);
		$sql2 = "INSERT INTO ".$tableName."(playerID, lastName, efficiency) VALUES('$row[0]', '$row[1]', '$row[2]')";
		mysqli_query($conn, $sql2);
		
	}
}//
// connect to match page
function calculateScore($teamName)
{
	
	$servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
	$dbname = "loginDB";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
	$sql = "SELECT efficiency from $teamName";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_all($result);
	var_dump($row);
	//echo $row[1][0];
	$tableName = $teamName;	
	//$totalscore=0;
	$count= 0;
	$average = 0;
	foreach($row as $playerID)
	{
		$average += $row[$count][0];
		$count++;
	}
	$total = $average/($count);
	//echo "\n".$total."\n";
	return $total;
}








?>
