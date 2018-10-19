#!/usr/bin/php
<?php
require_once('path.inc');	
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

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

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

