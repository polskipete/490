#!/usr/bin/php
<?php
var_dump($_POST);
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$username = $_POST['inputUser'];
$password = $_POST['inputPassword'];
echo "OUT \n";
echo($username);
if (isset($username))
{
	echo "in";
	$client = new rabbitMQClient("testRabbitMQ.ini","teamServer");
	if (isset($argv[1]))
	{
	  $msg = $argv[1];
	}
	else
	{
  	$msg = "test message";
	}

	$request = array();
	$request['type'] = "Login";
	$request['username'] = $username;
	$request['password'] = $password;
	$request['message'] = $msg;
	$request['array'] = array("atl", "bro", "bos", "cha", "chi", "cle", "dal", "den", "det", "gsw", "hou", "ind", "lac", "lal", "mem", "mia", "mil", "min", "nop", "nyk", "okl", "orl", "phi", "phx", "por", "sac", "sas", "tor", "uta", "was");

	$response = $client->send_request($request);
	
	//$response = $client->publish($request);

	echo "client received response: ".PHP_EOL;
	print_r($response);
	echo "\n\n";

	echo $argv[0]." END".PHP_EOL;
}
?>
