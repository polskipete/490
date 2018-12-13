#!/usr/bin/php
<?php
session_start();
include('config.php');
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
	$_SESSION['team']= $Team;	
	
	$player_id='hi';
	$count = 1;
	
		$sql = "SELECT firstName,lastName FROM playerTable WHERE playerID = $player1";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		$_SESSION["player1"] = $userRow['lastName']." ".$userRow['firstName'];

		$sql = "SELECT efficiency FROM playerTable WHERE playerID = $player1";
		$username = mysqli_query($conn, $sql);
		$userRow2 = mysqli_fetch_assoc($username);
		$_SESSION["player1_j"] = $userRow2['efficiency']; 
	
    		//--------------------------------------------------------------------------------
		
		$sql = "SELECT firstName,lastName FROM playerTable WHERE playerID = $player2";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		$_SESSION["player2"] = $userRow['lastName']." ".$userRow['firstName'];

		$sql = "SELECT efficiency FROM playerTable WHERE playerID = $player2";
		$username = mysqli_query($conn, $sql);
		$userRow2 = mysqli_fetch_assoc($username);
		$_SESSION["player2_j"] = $userRow2['efficiency']; 
	
    		//--------------------------------------------------------------------------------

		$sql = "SELECT firstName,lastName FROM playerTable WHERE playerID = $player3";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		$_SESSION["player3"] = $userRow['lastName']." ".$userRow['firstName'];

		$sql = "SELECT efficiency FROM playerTable WHERE playerID = $player3";
		$username = mysqli_query($conn, $sql);
		$userRow2 = mysqli_fetch_assoc($username);
		$_SESSION["player3_j"] = $userRow2['efficiency']; 
	
    		//--------------------------------------------------------------------------------

		$sql = "SELECT firstName,lastName FROM playerTable WHERE playerID = $player4";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		$_SESSION["player4"] = $userRow['lastName']." ".$userRow['firstName'];

		$sql = "SELECT efficiency FROM playerTable WHERE playerID = $player4";
		$username = mysqli_query($conn, $sql);
		$userRow2 = mysqli_fetch_assoc($username);
		$_SESSION["player4_j"] = $userRow2['efficiency']; 
	
    		//--------------------------------------------------------------------------------

		$sql = "SELECT firstName,lastName FROM playerTable WHERE playerID = $player5";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		$_SESSION["player5"] = $userRow['lastName']." ".$userRow['firstName'];

		$sql = "SELECT efficiency FROM playerTable WHERE playerID = $player5";
		$username = mysqli_query($conn, $sql);
		$userRow2 = mysqli_fetch_assoc($username);
		$_SESSION["player5_j"] = $userRow2['efficiency']; 
	
    		//--------------------------------------------------------------------------------

		$sql = "SELECT firstName,lastName FROM playerTable WHERE playerID = $player6";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		$_SESSION["player6"] = $userRow['lastName']." ".$userRow['firstName'];

		$sql = "SELECT efficiency FROM playerTable WHERE playerID = $player6";
		$username = mysqli_query($conn, $sql);
		$userRow2 = mysqli_fetch_assoc($username);
		$_SESSION["player6_j"] = $userRow2['efficiency']; 
	
    		//--------------------------------------------------------------------------------

		$sql = "SELECT firstName,lastName FROM playerTable WHERE playerID = $player7";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		$_SESSION["player7"] = $userRow['lastName']." ".$userRow['firstName'];

		$sql = "SELECT efficiency FROM playerTable WHERE playerID = $player7";
		$username = mysqli_query($conn, $sql);
		$userRow2 = mysqli_fetch_assoc($username);
		$_SESSION["player7_j"] = $userRow2['efficiency']; 
	
    		//--------------------------------------------------------------------------------

		$sql = "SELECT firstName,lastName FROM playerTable WHERE playerID = $player8";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		$_SESSION["player8"] = $userRow['lastName']." ".$userRow['firstName'];

		$sql = "SELECT efficiency FROM playerTable WHERE playerID = $player8";
		$username = mysqli_query($conn, $sql);
		$userRow2 = mysqli_fetch_assoc($username);
		$_SESSION["player8_j"] = $userRow2['efficiency']; 
	
    		//--------------------------------------------------------------------------------

		$sql = "SELECT firstName,lastName FROM playerTable WHERE playerID = $player9";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		$_SESSION["player9"] = $userRow['lastName']." ".$userRow['firstName'];

		$sql = "SELECT efficiency FROM playerTable WHERE playerID = $player9";
		$username = mysqli_query($conn, $sql);
		$userRow2 = mysqli_fetch_assoc($username);
		$_SESSION["player9_j"] = $userRow2['efficiency']; 
	
    		//--------------------------------------------------------------------------------

		$sql = "SELECT firstName,lastName FROM playerTable WHERE playerID = $player10";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		$_SESSION["player10"] = $userRow['lastName']." ".$userRow['firstName'];

		$sql = "SELECT efficiency FROM playerTable WHERE playerID = $player10";
		$username = mysqli_query($conn, $sql);
		$userRow2 = mysqli_fetch_assoc($username);
		$_SESSION["player10_j"] = $userRow2['efficiency']; 
	
    		//--------------------------------------------------------------------------------
	
	
	var_dump($Team);
	buildTeams($Team,$name);
	$_SESSION['team']= $Team;
	header("Location: ../phpFE/main.php"); /* Redirect browser */
 




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
