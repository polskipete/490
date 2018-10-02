#!/usr/bin/php
<?php
	$user = "peter";
	$pass = "1234";
	$servername = "localhost";
	$username = "dbAdmin";
	$password = "password123!";
	$dbname = "loginDB";
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if(!$conn)
	{
		printf("Connection Failed: ".mysqli_connect_error());
	}
	if($conn)
	{
		printf("Connection Succesful!");
	}
	
	$result = mysqli_query($conn, "select * from loginTable where username = '$user' and password ='$pass'") or die("Failed to query".mysqli_error());
	$row = mysqli_fetch_array($result);
	echo($row['username']);
	echo($row['password']);
	

require_once('path.inc');	
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password)
{
    // lookup username in databas
    // check password
    return true;
    //return false if not valid
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
    case "login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

