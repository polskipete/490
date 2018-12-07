#!/usr/bin/php
<?php
require_once('rosterconfig.php');
require_once('path.inc');	
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('playerStatsAPI.php');
$teams = array("atl", "bro", "bos", "cha", "chi", "cle", "dal", "den", "det", "gsw", "hou", "ind", "lac", "lal", "mem", "mia", "mil", "min", "nop", "nyk", "okl", "orl", "phi", "phx", "por", "sac", "sas", "tor", "uta", "was");
ClearPlayerDB();
foreach($teams as $team){
	echo $team;
	echo "\n";
	$stats = fetchPlayerData($team);
	storePlayerStats($stats);
	$count++;
	//probably will use for error logging, to make sure each team gets thro
	//var_dump($stats);
}


//check if all 30 teams get through
echo $count . "SERVER";
function doLogin($user,$pass)
{
	//Db login Variables
        $servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
	$dbname = "loginDB";
	//Try to connect to db and store the results in conn
        $conn = mysqli_connect($servername, $username, $password, $dbname);
	//Comment if DB login was succesful or not
	$date = new DateTime();
	$dateString = $date->format("y:m:d h:i:s");
        if(!$conn)
	{
		$error = $dateString." DB Connection Failed: ".mysqli_connect_error()."\n";
		file_put_contents('Errorlog.log', $error, FILE_APPEND);
	}
	else
	{
		// Now connected to database
		printf("DB Connection Succesful! \n");
		// Get data from database that equals the values recived from client
		$result = mysqli_query($conn, "select * from loginTable where username = '$user' and password ='$pass'") or die("Failed to query".mysqli_error());
		// Store data that was retrieved in an array
		$row = mysqli_fetch_array($result);
		// checks if login info is correct
        	if($row['username'] == $user && $row['password'] == $pass)
        	{
                	printf ("Login successful! \n Welcome user ".$row['username']);
                	return true;
        	}
        	//if it does not match return false 
        	else
       		{
			printf ('Login failed');
			$error = $dateString." Login failed"."\n";
			//file_put_contents('Errorlog.log', $error, FILE_APPEND);
                	return false;
        	}

  	}
}

function requestProcessor($request)
{
  $date = new DateTime();
  $dateString = $date->format("y:m:d h:i:s");
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    $error = $dateString." RabbitMQ request type invalid\n";
    file_put_contents('Errorlog.log', $error, FILE_APPEND);
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "Login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
	    return doValidate($request['sessionId']);
    case "getTeam":
	    return teamFetch($request['user'], $request['statement']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}
function ClearPlayerDB(){
	$servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
        $dbname = "loginDB";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
	$drop = "DROP TABLE playerTable";
	mysqli_query($conn, $drop);
}

function teamFetch($user, $sql)
{
        $servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
        $dbname = "loginDB";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
	if($conn){
		echo "connection";
	}
	echo "\n Passing through Rabbit!";
	$tableName = "team$user";
	$result = mysqli_query($conn, $sql);
	$row1 = mysqli_fetch_all($result);
	return $row1;
}
function dataStore($array){

	$servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
        $dbname = "loginDB";
	$date = new DateTime();
	$dateString = $date->format("y:m:d h:i:s");
	// $ array will store below function
	// = requestProcessor();
	//$array = array("12345", "Van Gundy", "Stan", "88", "DET", "0", "0", "0", "0", "0", "0", "0", "0", "2", "0");
	$i = 0;
	foreach($array as $stats)
	{
                $test[$i] = $stats;
                $i++;
	}	
        //Try to connect to db and store the results in conn
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        //Comment if DB login was succesful or not
        if(!$conn)
        {
		$error = $dateString." DB Connection Failed: ".mysqli_connect_error()."\n";
                file_put_contents('Errorlog.log', $error, FILE_APPEND);
        }
        else
	{
		$playerID = mysqli_real_escape_string($conn, $test[0]);
		$lastname = mysqli_real_escape_string($conn, $test[1]);
		$firstname = mysqli_real_escape_string($conn, $test[2]);
		$teamID = mysqli_real_escape_string($conn, $test[3]);
                $team = mysqli_real_escape_string($conn, $test[4]);
		$points = mysqli_real_escape_string($conn, $test[5]);
                $fieldGoals = mysqli_real_escape_string($conn, $test[6]);
		$fieldGoalsAtt = mysqli_real_escape_string($conn, $test[7]);
                $freethrowAttempt = mysqli_real_escape_string($conn, $test[8]);
                $freethrowMade = mysqli_real_escape_string($conn, $test[9]);
                $offensiveRebounds = mysqli_real_escape_string($conn, $test[10]);
                $defensiveRebounds = mysqli_real_escape_string($conn, $test[11]);
                $steals = mysqli_real_escape_string($conn, $test[12]);
                $assists = mysqli_real_escape_string($conn, $test[13]);
                $blocks = mysqli_real_escape_string($conn, $test[14]);
                $fouls = mysqli_real_escape_string($conn, $test[15]);
                $turnover = mysqli_real_escape_string($conn, $test[16]);
		$efficiency = mysqli_real_escape_string($conn, $test[17]);
                $createTable = "CREATE TABLE playerTable(playerID varchar(30), lastName varchar(30), firstName varchar(30), teamID varchar(30), team varchar(30), points varchar(30), FG varchar(30), FGAtt varchar(30), FTAttempt varchar(30), FTMade varchar(30), offRebounds varchar(30), defRebounds varchar(30), steals varchar(30), assists varchar(30), blocks varchar(30), fouls varchar(30), turnover varchar(30), efficiency varchar(30));";
		mysqli_query($conn, $createTable);

		$sql = "INSERT INTO playerTable(playerID, lastName, firstName, teamID, team, points, FG, FGAtt,FTAttempt, FTMade, offRebounds, defRebounds, steals, assists, blocks, fouls, turnover, efficiency) VALUES('$playerID', '$lastname', '$firstname', '$teamID', '$team', '$points','$fieldGoals', '$fieldGoalsAtt', '$freethrowAttempt', '$freethrowMade', '$offensiveRebounds', '$defensiveRebounds', '$steals', '$assists', '$blocks', '$fouls', '$turnover', '$efficiency')";
                if(mysqli_query($conn, $sql))
                {			                        
			echo "New record created\n";
                }       
                else
                {
                        echo "Error: ".$sql."<br>".mysqli_error($conn);
			$error = $dateString." New record not created ".mysqli_error($conn)."\n";                
			file_put_contents('Errorlog.log', $error, FILE_APPEND);
		}
        }  



}



function storePlayerStats ($obj){
		$playerCount = 0;
		$date = new DateTime();
		$dateString = $date->format("y:m:d h:i:s");
		if(!$obj)
		{
			file_put_contents('Errorlog.log', $dateString."URL not working\n", FILE_APPEND);
		}
		foreach ($obj["playerStatsTotals"] as $player){
			// all data for one player
			//var_dump($obj["playerStatsTotals"][$playerCount]);
			// Player Info
	
			// Personal
			$playerID = $obj["playerStatsTotals"][$playerCount]["player"]["id"];
			$last = $obj["playerStatsTotals"][$playerCount]["player"]["lastName"];
			$first = $obj["playerStatsTotals"][$playerCount]["player"]["firstName"];

			// Team
			$teamID = $obj["playerStatsTotals"][$playerCount]["player"]["currentTeam"]["id"];
			$team = $obj["playerStatsTotals"][$playerCount]["player"]["currentTeam"]["abbreviation"];
	 
			// Player stats
			// points ***
			$points = $assists = $obj["playerStatsTotals"][$playerCount]["stats"]["offense"]["pts"];
			// field goals made
			$fieldGoals = $obj["playerStatsTotals"][$playerCount]["stats"]["fieldGoals"]["fgMade"];
			// field goals attempted **
			$fieldGoalsAtt = $obj["playerStatsTotals"][$playerCount]["stats"]["fieldGoals"]["fgAtt"];
			// free throws attempted
			$freeThrowsAtt = $obj["playerStatsTotals"][$playerCount]["stats"]["freeThrows"]["ftAtt"];
			// free throws made
			$freeThrowsMade = $obj["playerStatsTotals"][$playerCount]["stats"]["freeThrows"]["ftMade"];
			// Offensive rebounds
			$offRebounds = $obj["playerStatsTotals"][$playerCount]["stats"]["rebounds"]["offReb"];
			// defensive rebounds
			$defRebounds = $obj["playerStatsTotals"][$playerCount]["stats"]["rebounds"]["defReb"];
			// steals
			$steals = $obj["playerStatsTotals"][$playerCount]["stats"]["defense"]["stl"];
			// assists
			$assists = $obj["playerStatsTotals"][$playerCount]["stats"]["offense"]["ast"];
			// blocks
			$blocks = $obj["playerStatsTotals"][$playerCount]["stats"]["defense"]["blk"];
			// fouls
			$fouls = $obj["playerStatsTotals"][$playerCount]["stats"]["miscellaneous"]["fouls"];
			// turnover
			$turnover = $obj["playerStatsTotals"][$playerCount]["stats"]["defense"]["tov"];
			
			//Points Scored + (.4 * Field Go&l) - (.7 * Field Go&l Attempt) - (.4 * (Free Throw Attempt - Free Throw)) + (.7 * Offensive Rebounds) + (.3 * Defensive Rebounds) + Ste&ls + (.7 * Assists) + (.7 * Blocks) - (.4 * Person&l Fouls) - Turnover

			$efficiency = $points + (0.4 * $fieldGoals) - (0.7 * $fieldGoalsAtt) - (0.4 * ($freeThrowsAtt - $freeThrowsMade)) + (0.7 * $offRebounds) + ( 0.3 * $defRebounds) + $steals + (0.7 * $assists) + (0.7 * $blocks) - (0.4 * $fouls) - $turnover;
			$playerCount += 1; 
			$statsArray = array($playerID, $last, $first, $teamID, $team, $points, $fieldGoals, $fieldGoalsAtt, $freeThrowsAtt, $freeThrowsMade, $offRebounds,$defRebounds, $steals, $assists, $blocks, $fouls, $turnover, $efficiency);
			//var_dump($statsArray);
			//STORE DATA HERE
			dataStore($statsArray);
	}
}

$server = new rabbitMQServer("RabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

