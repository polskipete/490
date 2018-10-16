#!/usr/bin/php
<?php
//All teams abriviation
$teams = array("atl", "bro", "bos", "cha", "chi", "cle", "dal", "den", "det", "gsw", "hou", "ind", "lac", "lal", "mem", "mia", "mil", "min", "nop", "nyk", "okl", "orl", "phi", "phx", "por", "sac", "sas", "tor", "uta", "was");
$count = 0;
//will enclose all curl operations and data
foreach($teams as $team){
	echo $team;
	echo "\n";

	//probably will use for error logging, to make sure each team gets thro
	$count++;
}
//check if all 30 teams get through
echo $count;
// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'https://api.mysportsfeeds.com/v2.0/pull/nba/2017-2018-regular/player_stats_totals.json?team=det');

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set compression
curl_setopt($ch, CURLOPT_ENCODING, "gzip");

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	"Authorization: Basic " . base64_encode( '4cba762b-6615-4c0e-a99f-ccc429' . ":" . 'MYSPORTSFEEDS')
]);

// Send the request & save response to $resp
$resp = curl_exec($ch);

if (!$resp) {
	die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
	echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "\n";
	//echo "\nResponse HTTP Body : " . $resp;
	file_put_contents('myfile.txt', $resp);
	$obj = json_decode($resp, true);
	$playerCount = 0;
	
	foreach ($obj["playerStatsTotals"] as $player){
		// all data for one player
		var_dump($obj["playerStatsTotals"][$playerCount]);
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
		echo $playerID . "\n" . $last . "\n" . $first . "\n" . $teamID . "\n" . $team . "\n" ;
		echo $feildGoals . "\n" . $freeThrowsAtt . "\n" . $freeThrowsMade . "\n" . $offRebounds . "\n" . $defRebounds . "\n";
		echo $steals . "\n" . $assists . "\n" . $blocks . "\n" . $fouls . "\n" . $turnover . "\n";
		
		$playerCount += 1; 
	}
echo "\n\n" . $playerCount;
}
//echo $count;
// Close request to clear up some resources
curl_close($ch);

?>
