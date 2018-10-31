#!/usr/bin/php
<?php

session_start();
include("config.php");
include("calculateScore.php");
echo "\n SESSION \n";
$_GET['username'];
echo $_SESSION['name'];

//var_dump( $conn);

//mock data
$username = $_SESSION['name'];



$sql = "SELECT userID FROM loginTable WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sql= "select MAX(userID) from loginTable;";
$result = mysqli_query($conn, $sql);
$countRow = mysqli_fetch_assoc($result);
$max = intval($countRow['MAX(userID)']);
echo $max; 
$sql= "select MIN(userID) from loginTable;";
$result = mysqli_query($conn, $sql);
$countRow = mysqli_fetch_assoc($result);
$min = intval($countRow['MIN(userID)']);
echo $min;
do
{
	$randomID = rand($min, $max);
} while($row["userID"] == $randomID);

//echo $randomID;

//store id in a variable to use in function
$mainUserID = $row["userID"];
playMatch($randomID, $mainUserID, $conn);
//echo "Result: " . $row['userID'];
//BUG: SETTING STATS TO ZERO: FIX IDEA GET VALUES AND SWITCH TO INT THEN ADD THEN INSERT INTO TABLES
function playMatch($opponentID, $mainUserID, $conn){
	//echo $mainUserID. "\n";
	// returns score
	$sql = "SELECT username FROM loginTable WHERE userID = '$mainUserID'";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		echo "team".$userRow["username"] . "\n\n\n";
	$teamName= "team".$userRow["username"];

	
	$sql = "SELECT username FROM loginTable WHERE userID = '$opponentID'";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		echo "team".$userRow["username"] . "\n\n\n";
	$teamNameOpp= "team".$userRow["username"];



	$mainUserScore = calculateScore($teamName);
	echo $mainUserScore."\n";
	$opponentUserScore = calculateScore($teamNameOpp);
	echo $opponentUserScore;
	$test = 1;
	// this needs to be updated this is sudo code
	if ($mainUserScore > $opponentUserScore){
		$sql = "SELECT win FROM loginTable WHERE userID = '$mainUserID'";
		$win = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($win);
		$userRow["win"] += 1;
		echo $userRow["win"];
		$sqlTest = "UPDATE loginTable SET win = '$userRow[win]' where userID = $mainUserID ";
		$winUpdate = mysqli_query($conn, $sqlTest);
		
		//Opp lost
		$sql = "SELECT loss FROM loginTable WHERE userID = '$opponentID'";
		$loss = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($loss);
		// this might not work
		$userRow["loss"] += 1;
		echo $userRow["loss"];
		$sqlTest = "UPDATE loginTable SET loss = '$userRow[loss]' where userID = $opponentID ";
		$winUpdate = mysqli_query($conn, $sqlTest);
		
	}
	elseif ($mainUserScore < $opponentUserScore){
		$sql = "SELECT loss FROM loginTable WHERE userID = '$mainUserID'";
		$win = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($loss);
		// this might not work
		$userRow["loss"] += 1;
		echo $userRow["loss"];
		$sqlTest = "UPDATE loginTable SET loss = '$userRow[loss]' where userID = $mainUserID ";
		$winUpdate = mysqli_query($conn, $sqlTest);
		
		//Player win
		$sql = "SELECT win FROM loginTable WHERE userID = '$opponentID'";
		$loss = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($win);
		// this might not work
		$userRow["win"] += 1;
		//echo $userRow["win"];
		$sqlTest = "UPDATE loginTable SET win = '$userRow[win]' where userID = $opponentID ";
		$winUpdate = mysqli_query($conn, $sqlTest);	
	}
	else {
		echo "DRAW";
		$sql = "SELECT draw FROM loginTable WHERE userID = '$mainUserID'";
		$draw = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($draw);
		// this might not work
		$userRow["draw"] += 1;
		echo $userRow["draw"];
		$sqlTest = "UPDATE loginTable SET draw = '$userRow[draw]' where userID = $mainUserID ";
		$winUpdate = mysqli_query($conn, $sqlTest);
		
		//Player win
		$sql = "SELECT draw FROM loginTable WHERE userID = '$opponentID'";
		$draw2 = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($draw);
		// this might not work
		$userRow["draw"] += 1;
		//echo $userRow["win"];
		$sqlTest = "UPDATE loginTable SET draw = '$userRow[draw]' where userID = $opponentID ";
		$winUpdate = mysqli_query($conn, $sqlTest);
	}

}
		


?>
