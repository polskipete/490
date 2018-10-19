#!/usr/bin/php
<?php
function fetchPlayerData($team){
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
		//file_put_contents('myfile.txt', $resp);
		$obj = json_decode($resp, true);
		return $obj;
	//echo "\n\n" . $playerCount;
	}
	//echo $count;
	// Close request to clear up some resources
	curl_close($ch);
}
?>
