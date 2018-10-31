#!/usr/bin/php
<?php
session_start();
$_GET['username'];
$name= $_SESSION['name'];

	$player1 = $_POST['player1search'];
	$player2 = $_POST['player2search'];
	$player3 = $_POST['player3search'];
	$player4 = $_POST['player4search'];
	$player5 = $_POST['player5search'];
	$player6 = $_POST['player6search'];
	$player7 = $_POST['player7search'];
	$player8 = $_POST['player8search'];
	$player9 = $_POST['player9search'];
	$player10 = $_POST['player10search'];

	$Team = array($player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10);
	var_dump($Team);
	buildTeams($Team,$name);
	$_SESSION['team']= $Team;
	header("Location: http://127.0.0.1/teamdisplay.php"); /* Redirect browser */
 




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









?>
