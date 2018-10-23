#!/usr/bin/php
<?php
//$playerIDs must be an array

//playerIDs roster mock
$players = array("team1", "9249", "9411");
$teamName = $players[0];
buildTeams($players);
calculateScore($players, $teamName);
function buildTeams($playerIDs)
{
        $servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
	$dbname = "loginDB";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
	$tableName = $playerIDs[0];
	$sql3 = "drop table ".$tableName;
	mysqli_query($conn, $sql3);
	$sql = "CREATE TABLE ".$tableName."(playerID varchar(30), lastName varchar(30), efficiency varchar(30))";	
	mysqli_query($conn, $sql);
	array_splice($playerIDs, 0, 1);
	foreach($playerIDs as $playerID)
	{
		$playerStats = "select playerID, lastName, efficiency from playerTable where playerID ='$playerID'";
		$result = mysqli_query($conn, $playerStats);
		$row = mysqli_fetch_row($result);
		//var_dump($result);
		$sql2 = "INSERT INTO ".$tableName."(playerID, lastName, efficiency) VALUES('$row[0]', '$row[1]', '$row[2]')";
		mysqli_query($conn, $sql2);
		
	}
}

function calculateScore($playerIDs, $teamName)
{
	
	$servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
	$dbname = "loginDB";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
	$tableName = $teamName;	
	$totalscore=0;
	foreach($playerIDs as $playerID)
	{
		$sql = "select efficiency from ".$tableName." where playerID = '$playerID'";
		$result = mysqli_query($conn, $sql);
		if(!$result)
		{
			//Error logging to be added here
			printf("Error: %s\n", mysqli_error($conn));
		}
		$row = mysqli_fetch_row($result);
		echo $row[0]."\n";
		$totalscore += (float)$row[0];	
	}
	echo $totalscore;
}








?>
