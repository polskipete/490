#!/usr/bin/php
<?php
//All teams abriviation
$teams = array("atl", "bro", "bos", "cha", "chi", "cle", "dal", "den", "det", "gsw", "hou", "ind", "lac", "lal", "mem", "mia", "mil", "min", "nop", "nyk", "okl", "orl", "phi", "phx", "por", "sac", "sas", "tor", "uta", "was");
$count = 0;
//will enclose all curl operations and data
foreach($teams as $team){
	echo $team;
	echo "\n";

	//probably will use for error logging, to make sure each team gets through
	$count++;
}
//check if all 30 teams get through
echo $count;
// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'https://api.mysportsfeeds.com/v1.2/pull/nba/2017-2018-regular/cumulative_player_stats.json?team=okl');

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set compression
curl_setopt($ch, CURLOPT_ENCODING, "gzip");

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	"Authorization: Basic " . base64_encode( '4cba762b-6615-4c0e-a99f-ccc429' . ":" . 'njitmysportsfeeds')
]);

// Send the request & save response to $resp
$resp = curl_exec($ch);

if (!$resp) {
	die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
	//echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
	//echo "\nResponse HTTP Body : " . $resp;
	file_put_contents('myfile.json', $resp);
	$obj = json_decode($resp, true);
	//Gets exact player stats from team
	var_dump($obj['cumulativeplayerstats']['playerstatsentry'][0]);
	//find out array length of 
	foreach ($obj as $player){
		//var_dump($player);
		$count++;
	}
	
}
echo $count;
// Close request to clear up some resources
curl_close($ch);

?>
