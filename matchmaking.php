#!/usr/bin/php
<?php

include("config.php");
include("buildTeams.php");
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

echo $randomID;

//store id in a variable to use in function
$mainUserID = $row["userID"];
playerMatch();
//echo "Result: " . $row['userID'];
//$
function playMatch($opponentID, $mainUserID){

	// returns score
	$mainUserScore = calculateScore($mainUserID, $teamName);
	$opponentUserScore = calculateScore($$opponentID, $teamName);

	// this needs to be updated this is sudo code
	if ($mainUserScore >= $opponentUserScore){
		
		$sql = "SELECT win FROM loginTable WHERE username = '$mainUserID'";
		$win = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($win);
		// this might not work
		$userRow["win"] += 1;
		// insert new $userRow["win"] into db $userRow["win"]
		$sql2 = "SELECT loss FROM loginTable WHERE username = '$opponentID'";
		//Do the same as above for here but with loss instead
		
	}
	elseif ($mainUserScore >= $opponentUserScore){
		
	}
	else {
	}

}
		


?>
