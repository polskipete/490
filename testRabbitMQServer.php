#!/usr/bin/php
<?php
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
	//probably will use for error logging, to make sure each team gets thro
	//var_dump($stats);
	$count++;
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
		file_put_contents('Errorlog.txt', $error, FILE_APPEND);
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
			file_put_contents('Errorlog.txt', $error, FILE_APPEND);
                	return false;
        	}

  	}
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "Login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
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

function dataStore($array){

	$servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
        $dbname = "loginDB";
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
                 die("Connection failed: " . mysqli_connect_error());
        }
        else
	{
		$playerID = mysqli_real_escape_string($conn, $test[0]);
		$firstname = mysqli_real_escape_string($conn, $test[2]);
		$lastname = mysqli_real_escape_string($conn, $test[1]);
		$teamID = mysqli_real_escape_string($conn, $test[3]);
                $team = mysqli_real_escape_string($conn, $test[4]);
                $fieldGoals = mysqli_real_escape_string($conn, $test[5]);
                $freethrowAttempt = mysqli_real_escape_string($conn, $test[6]);
                $freethrowMade = mysqli_real_escape_string($conn, $test[7]);
                $offensiveRebounds = mysqli_real_escape_string($conn, $test[8]);
                $defensiveRebounds = mysqli_real_escape_string($conn, $test[9]);
                $steals = mysqli_real_escape_string($conn, $test[10]);
                $assists = mysqli_real_escape_string($conn, $test[11]);
                $blocks = mysqli_real_escape_string($conn, $test[12]);
                $fouls = mysqli_real_escape_string($conn, $test[13]);
                $turnover = mysqli_real_escape_string($conn, $test[14]);
                $createTable = "CREATE TABLE playerTable(playerID varchar(30), lastName varchar(30), firstName varchar(30), teamID varchar(30), team varchar(30), fieldGoals varchar(30), freethrowAttempt varchar(30), freethrowMade varchar(30), offensiveRebounds varchar(30), defensiveRebounds varchar(30), steals varchar(30), assists varchar(30), blocks varchar(30), fouls varchar(30), turnover varchar(30));";
		mysqli_query($conn, $createTable);

		$sql = "INSERT INTO playerTable(playerID, lastName, firstName, teamID, team, fieldGoals, freethrowAttempt, freethrowMade, offensiveRebounds, defensiveRebounds, steals, assists, blocks, fouls, turnover) VALUES('$playerID', '$lastname', '$firstname', '$teamID', '$team', '$fieldGoals', '$freethrowAttempt', '$freethrowMade', '$offensiveRebounds', '$defensiveRebounds', '$steals', '$assists', '$blocks', '$fouls', '$turnover')";
                if(mysqli_query($conn, $sql))
                {
                        echo "New record created\n";
                }       
                else
                {
                        echo "Error: ".$sql."<br>".mysqli_error($conn);
                }
        }  



}



function storePlayerStats ($obj){
		$playerCount = 0;
		
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

			// field goals attempted
			$feildGoals = $obj["playerStatsTotals"][$playerCount]["stats"]["fieldGoals"]["fgAtt"];
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
			
			// Test if data is stored properly on variable
			//echo $playerID . "\n" . $last . "\n" . $first . "\n" . $teamID . "\n" . $team . "\n" ;
			//echo $feildGoals . "\n" . $freeThrowsAtt . "\n" . $freeThrowsMade . "\n" . $offRebounds . "\n" . $defRebounds . "\n";
			//echo $steals . "\n" . $assists . "\n" . $blocks . "\n" . $fouls . "\n" . $turnover . "\n";
			$playerCount += 1; 
			$statsArray = array($playerID, $last, $first, $teamID, $team, $feildGoals, $freeThrowsAtt, $freeThrowsMade, $offRebounds,$defRebounds, $steals, $assists, $blocks, $fouls, $turnover);
			//var_dump($statsArray);
			//STORE DATA HERE
			dataStore($statsArray);
	}
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

