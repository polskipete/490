#!/usr/bin/php
<?php

include("config.php");
include("buildTeams.php");
echo "\n BREAK \n";
//var_dump( $conn);

//mock data
$username = "jonathan";



$sql = "SELECT userID FROM loginTable WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


do
{
	$randomID = rand(1, 5);
} while($row["userID"] == $randomID);

//echo $randomID;

//store id in a variable to use in function
$mainUserID = $row["userID"];
playMatch($randomID, $mainUserID, $conn);
//echo "Result: " . $row['userID'];
//$
function playMatch($opponentID, $mainUserID, $conn){
	//echo $mainUserID. "\n";
	// returns score
	$teamName= "team1";
	$teamNameOpp="team1";
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
		// this might not work
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
		$userRow = mysqli_fetch_assoc($win);
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
