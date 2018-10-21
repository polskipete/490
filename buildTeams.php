#!/usr/bin/php
<?php
//$playerIDs must be an array

//playerIDs roster mock
$players = array("team1", "9249", "9411");

buildTeams($players);

function buildTeams($playerIDs)
{
        $servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
	$dbname = "loginDB";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
	$tableName = $playerIDs[0];
	$sql = "CREATE TABLE ".$tableName."(playerID varchar(30), lastName varchar(30), efficiency varchar(30))";	
	mysqli_query($conn, $sql);
	array_splice($playerIDs, 0, 1);
	foreach($playerIDs as $playerID)
	{
		$playerStats = "select playerID, lastName, efficiency from playerTable where playerID ='$playerID'";
		$result = mysqli_query($conn, $playerStats);
		$row = mysqli_fetch_row($result);
		//var_dump($result);
		echo $row[0] . " ";
		echo $row[1] . " ";
		echo $row[2] . "\n";
		$sql2 = "INSERT INTO ".$tableName."(playerID, lastName, efficiency) VALUES('$row[0]', '$row[1]', '$row[2]')";
		mysqli_query($conn, $sql2);
		
	}
}

function calculateScore()
{
	$servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
	$dbname = "loginDB";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
}








?>
