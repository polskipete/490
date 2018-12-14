#!/usr/bin/php
<?php

session_start();
include("./config.php");
include("./calculateScore.php");
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
//echo $max; 
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
		//echo "team".$userRow["username"] . "\n\n\n";
	$teamName= "team".$userRow["username"];
	$historyName= "history".$userRow["username"];
	
	$sql = "SELECT username FROM loginTable WHERE userID = '$opponentID'";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		//echo "team".$userRow["username"] . "\n\n\n";
	$teamNameOpp= "team".$userRow["username"];
	$historyNameOpp= "history".$userRow["username"];


	$mainUserScore = calculateScore($teamName);
	echo $mainUserScore."\n";
	$opponentUserScore = calculateScore($teamNameOpp);
	echo $opponentUserScore;

	
	//$test = 1;
	//Mock Data
	//$mainUserID= 2;
	// this needs to be updated this is sudo code
	$time = date('Y-m-d G:i:s');
	if ($mainUserScore > $opponentUserScore){
		$sql = "SELECT win FROM loginTable WHERE userID = '$mainUserID'";
		$sql2 = "SELECT money FROM loginTable WHERE userID = '$mainUserID'";
		$win = mysqli_query($conn, $sql);
		$money = mysqli_query($conn, $sql2);
		$userRow = mysqli_fetch_assoc($win);
		$moneyRow = mysqli_fetch_assoc($money);
		$winInt = ((int)$userRow["win"] + 1);
		$moneyAdd = ((int)$moneyRow["money"]+50);
		//$userRow["win"] += 1;
		$sqlTest = "UPDATE loginTable SET win = '$winInt' where userID = $mainUserID ";
		$sqlMoneyUpdate = "UPDATE loginTable SET money = '$moneyAdd' where userID = $mainUserID";
		$sqlHistory = "INSERT INTO $historyName(money, date, loss_win_draw) VALUES('$moneyAdd', '$time', 'win')";
		$winUpdate = mysqli_query($conn, $sqlTest);
		$sqlMoneyUpdate = mysqli_query($conn, $sqlMoneyUpdate);
		$historyUpdate = mysqli_query($conn, $sqlHistory);
		
		//Opp lost
		$sql = "SELECT loss FROM loginTable WHERE userID = '$opponentID'";
		$sql2 = "SELECT money FROM loginTable WHERE userID = '$opponentID'";
		$loss = mysqli_query($conn, $sql);
		$money = mysqli_query($conn, $sql2);
		$userRow = mysqli_fetch_assoc($loss);
		$moneyRow = mysqli_fetch_assoc($money);
		$lossInt = ((int)$userRow["loss"]) + 1;
		$moneyAdd = ((int)$moneyRow["money"]-50);
		// this might not work
		//$userRow["loss"] += 1;
		$sqlTest = "UPDATE loginTable SET loss = '$lossInt' where userID = $opponentID ";
		$sqlMoneyUpdate = "UPDATE loginTable SET money = '$moneyAdd' where userID = $opponentID";
		$sqlHistory = "INSERT INTO $historyNameOpp(money, date, loss_win_draw) VALUES('$moneyAdd', '$time', 'loss')";
		//$sqlHistory2 = "UPDATE MockHistory SET lossOrGain = 'loss' WHERE username = 'Jonathan'";
		$winUpdate = mysqli_query($conn, $sqlTest);
		$sqlMoneyUpdate = mysqli_query($conn, $sqlMoneyUpdate);
		$historyUpdate = mysqli_query($conn, $sqlHistory);
		//$historyUpdate2 = mysqli_query($conn, $sqlHistory);
		
	}
	elseif ($mainUserScore < $opponentUserScore){
		$sql = "SELECT loss FROM loginTable WHERE userID = '$mainUserID'";
		$sql2 = "SELECT money FROM loginTable WHERE userID = '$mainUserID'";
		$loss = mysqli_query($conn, $sql);
		$money = mysqli_query($conn, $sql2);
		$userRow = mysqli_fetch_assoc($loss);
		$moneyRow = mysqli_fetch_assoc($money);
		$lossInt = ((int)$userRow["loss"]) + 1;
		$moneyAdd = ((int)$moneyRow["money"]-50);
		// this might not work
		//$userRow["loss"] += 1;
		$sqlTest = "UPDATE loginTable SET loss = '$lossInt' where userID = $mainUserID ";
		$sqlMoneyUpdate = "UPDATE loginTable SET money = '$moneyAdd' where userID = $mainUserID";
		$sqlHistory = "INSERT INTO $historyName(money, date, loss_win_draw) VALUES('$moneyAdd', '$time', 'loss')";
		$winUpdate = mysqli_query($conn, $sqlTest);
		$sqlMoneyUpdate = mysqli_query($conn, $sqlMoneyUpdate);
		$historyUpdate = mysqli_query($conn, $sqlHistory);
		
		//Player win
		$sql = "SELECT win FROM loginTable WHERE userID = '$opponentID'";
		$sql2 = "SELECT money FROM loginTable WHERE userID = '$opponentID'";
		$win = mysqli_query($conn, $sql);
		$money = mysqli_query($conn, $sql2);
		$userRow = mysqli_fetch_assoc($win);
		$moneyRow = mysqli_fetch_assoc($money);
		$winInt = ((int)$userRow["win"]) + 1;
		$moneyAdd = ((int)$moneyRow["money"]+50);
		// this might not work
		//$userRow["win"] += 1;
		$sqlTest = "UPDATE loginTable SET win = '$winInt' where userID = $opponentID ";
		$sqlMoneyUpdate = "UPDATE loginTable SET money = '$moneyAdd' where userID = $opponentID";
		$sqlHistory = "INSERT INTO $historyNameOpp(money, date, loss_win_draw) VALUES('$moneyAdd', '$time', 'win')";
		$winUpdate = mysqli_query($conn, $sqlTest);
		$sqlMoneyUpdate = mysqli_query($conn, $sqlMoneyUpdate);
		$historyUpdate = mysqli_query($conn, $sqlHistory);	
	}
	else {
		$sql = "SELECT draw FROM loginTable WHERE userID = '$mainUserID'";
		$sql2 = "SELECT money FROM loginTable WHERE userID = '$mainUserID'";
		$draw = mysqli_query($conn, $sql);
		$money = mysqli_query($conn, $sql2);
		$userRow = mysqli_fetch_assoc($draw);
		$moneyRow = mysqli_fetch_assoc($money);
		$drawInt = ((int)$userRow["draw"]) + 1;
		$moneyAdd = ((int)$moneyRow["money"]+0);
		// this might not work
		//$userRow["draw"] += 1;
		$sqlTest = "UPDATE loginTable SET draw = '$drawInt' where userID = $mainUserID ";
		$sqlMoneyUpdate = "UPDATE loginTable SET money = '$moneyAdd' where userID = $mainUserID";
		$sqlHistory = "INSERT INTO $historyName(money, date, loss_win_draw) VALUES('$moneyAdd', '$time', 'draw')";
		$winUpdate = mysqli_query($conn, $sqlTest);
		$sqlMoneyUpdate = mysqli_query($conn, $sqlMoneyUpdate);
		$historyUpdate = mysqli_query($conn, $sqlHistory);
		
		//Player win
		$sqlTwo = "SELECT draw FROM loginTable WHERE userID = '$opponentID'";
		$sql2 = "SELECT money FROM loginTable WHERE userID = '$opponentID'";
		$drawTwo = mysqli_query($conn, $sqlTwo);
		$money = mysqli_query($conn, $sql2);
		$userRowTwo = mysqli_fetch_assoc($drawTwo);
		$moneyRow = mysqli_fetch_assoc($money);
		$drawIntTwo = ((int)$userRowTwo["draw"]) + 1;
		$moneyAdd = ((int)$moneyRow["money"]+0);
		// this might not work
		//$userRow["draw"] += 1;
		$sqlTestTwo = "UPDATE loginTable SET draw = '$drawIntTwo' where userID = $opponentID ";
		$sqlMoneyUpdate = "UPDATE loginTable SET money = '$moneyAdd' where userID = $opponentID";
		$sqlHistory = "INSERT INTO $historyNameOpp(money, date, loss_win_draw) VALUES('$moneyAdd', '$time', 'draw')";
		$winUpdate = mysqli_query($conn, $sqlTestTwo);
		$sqlMoneyUpdate = mysqli_query($conn, $sqlMoneyUpdate);
		$historyUpdate = mysqli_query($conn, $sqlHistory);
	}

	//----------------------------------------------------------------------------------------------------------------------------HISTORY SECTION
		
		//$_SESSION["hmoney"] = $moneyAdd;
		//$_SESSION["hdate"] = $time;

		//$sql = "select loss_win_draw from $historyName";
		//$h_lwd = mysqli_query($conn, $sql);
		//$userRow2 = mysqli_fetch_assoc($h_lwd);
		//$_SESSION["h_lwd"] = $userRow2['loss_win_draw']; 

		//$recent_h = array($_SESSION["hmoney"],$_SESSION["hdate"],$_SESSION["h_lwd"]);
		//$_SESSION["recent_h"] = $recent_h;

		//echo ("money1:   "); echo ($_SESSION["hmoney"]);
		//echo ("date1:   "); echo ($_SESSION["hdate"]);
		//echo ("win-loss3:   "); echo ($_SESSION["h_lwd"]);
		
		$sql = "SELECT max(matchID) FROM $historyName;";
		$maxcount = mysqli_query($conn, $sql);
		$hRow = mysqli_fetch_assoc($maxcount);
		var_dump ($hRow);
		$maxhistory = $hRow["max(matchID)"];
		//echo ($maxhistory);
		
		//------------------------------------------------------------------------------------------------

		$count = 10;
		$count1 = 1;
		$maxhis = $maxhistory;
	
		while ($count>0){
			$sql = "SELECT date FROM $historyName where matchID = $maxhistory"; 
			$match = mysqli_query($conn, $sql);
			$ha_row = mysqli_fetch_assoc($match);
			//var_dump ($ha_row);
			$dhistory = $ha_row["date"];
			//echo($dhistory);
			$_SESSION["matchd"."$count1"] = $dhistory;
			//echo($_SESSION["match"."$count1"]);
			$count--;
			$maxhistory--;
			$count1++;
		}
		
		$maxhistory = $maxhis;
		
		//------------------------------------------------------------------------------------------------

		$count = 10;
		$count1 = 1;
		$maxhis = $maxhistory;
	
		while ($count>0){
			$sql = "SELECT loss_win_draw FROM $historyName where matchID = $maxhistory"; 
			$match = mysqli_query($conn, $sql);
			$hd_row = mysqli_fetch_assoc($match);
			//var_dump ($ha_row);
			$mhistory = $hd_row["loss_win_draw"];
			//echo($mhistory);
			$_SESSION["matchl"."$count1"] = $mhistory;
			//echo($_SESSION["match"."$count1"]);
			$count--;
			$maxhistory--;
			$count1++;
		}
		
		$maxhistory = $maxhis;
		
		//------------------------------------------------------------------------------------------------

		$count = 10;
		$count1 = 1;
		$maxhis = $maxhistory;
	
		while ($count>0){

			$sql = "SELECT money FROM $historyName where matchID = $maxhistory"; 
			$match = mysqli_query($conn, $sql);
			$hm_row = mysqli_fetch_assoc($match);

			//var_dump ($ha_row);
			$mhistory = $hm_row["money"];
			//echo($mhistory);
			$_SESSION["matchm"."$count1"] = $mhistory;
			//echo($_SESSION["match"."$count1"]);
			$count--;
			$maxhistory--;
			$count1++;
		}
		
		//echo ($_SESSION["matchm1"]);
		//echo ($_SESSION["matchl1"]);
		//echo ($_SESSION["matchd1"]);

	//----------------------------------------------------------------------------------------------------------------------------
	
	header('Location: ../phpFE/main.php');

}
		


?>
