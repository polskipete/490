#!/usr/bin/php
<?php
//bkn, okc
$teams = array("atl", "bro", "bos", "cha", "chi", "cle", "dal", "den", "det", "gsw", "hou", "ind", "lac", "lal", "mem", "mia", "mil", "min", "nop", "nyk", "okl", "orl", "phi", "phx", "por", "sac", "sas", "tor", "uta", "was");
$count = 0;
foreach($teams as $team){
	echo $team;
	echo "\n";
	$count++;
}
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
	//$json_data = json_encode($resp);
	file_put_contents('myfile.json', $resp);
	$obj = json_decode($resp, true);
	var_dump($obj);
	//file_put_contents('my.txt', $obj);
}

// Close request to clear up some resources
curl_close($ch);

?>
