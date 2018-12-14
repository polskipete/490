#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include("deployment/dbconfig.php");
//	$client = new rabbitMQClient("RabbitMQ.ini","testServer");
  //      if (isset($argv[1]))
    //    {
      //    $msg = $argv[1];
       // }
       // else
       // {
       // $msg = "test message";
       // }
//	$request = array();
  //      $request['type'] = "sendTar";
//        $request['username'] = $username;
//        $request['password'] = $password;
//        $request['message'] = $msg;
//        $response = $client->send_request($request);
        //$response = $client->publish($request);
echo "Hello! Would you like to rollback or update?:";
$handle = fopen("php://stdin","r");
$line = fgets($handle);
if(trim($line) == 'update')
{
	//Enter update code here
	echo "Updating!\n";
	if($conn)
	{
		$versionSQL = "SELECT MAX(Version) FROM deploymentTable";
		$versionArray = mysqli_query($conn, $versionSQL);
		$version = mysqli_fetch_assoc($versionArray);
                $max = intval($version['MAX(Version)']);
		//var_dump($version);
		echo $max."\n";
		echo "Which would you like to send? phpBE, phpFE, or html: ";
		$handler = fopen("php://stdin","r");
		$lines = fgets($handler);
		/*
		$typeStatement = "SELECT Type from deploymentTable WHERE Version= $max";		               
		$types = mysqli_query($conn, $typeStatement);
		$typeArray = mysqli_fetch_assoc($types);
		$type = strval($typeArray['Type']);
		echo $type."\n";
		 */
		$condition = true;
		do{
                        $typeStatement = "SELECT Type from deploymentTable WHERE Version= $max";
	                $types = mysqli_query($conn, $typeStatement);
        	        $typeArray = mysqli_fetch_assoc($types);
                	$type = strval($typeArray['Type']);
			echo $type."\n";
			if(trim($lines) == $type)
			{
				$fileName = "SELECT FileName from deploymentTable WHERE Version = $max";
	                	$FileN = mysqli_query($conn, $fileName);
				$condition = false;
			}	
			$max = $max - 1;
			sleep(1);
		}while($condition);
		$max++;
		/*if(trim($lines) == "html")
		{
			$fileName = "SELECT FileName from deploymentTable WHERE (Version = $max AND Type = 'html')";
		}
                if(trim($lines) == "phpBE")
                {
               		$fileName = "SELECT FileName from deploymentTable WHERE (Version = $max AND Type = 'phpBE')";

		}
                if(trim($lines) == "phpFE")
                {
                	$fileName = "SELECT FileName from deploymentTable WHERE (Version = $max AND Type = 'phpFE')";
       
		}
		 */
                $FileN = mysqli_query($conn, $fileName);
		$FileArray = mysqli_fetch_assoc($FileN);
                $ActualName = strval($FileArray['FileName']);
		//var_dump($FileArray);
		echo $ActualName."\n";
	}
	$vstat = $ActualName;
	//exit;
}
if(trim($line) == 'rollback')
{
	//Enter rollback code here
	echo "Rolling back!\n";
        if($conn)
        {
                $versionSQL = "SELECT MAX(Version) FROM deploymentTable";
                $versionArray = mysqli_query($conn, $versionSQL);
                $version = mysqli_fetch_assoc($versionArray);
                $max = intval($version['MAX(Version)']);
                //var_dump($version);
		echo $max."\n";
	}
                echo "Which would you like to rollback? phpBE, phpFE, or html: ";
                $handler = fopen("php://stdin","r");
                $lines = fgets($handler);

		$condition = true;
		$fallback = 0;
                $max = $max - 1;

	do{
                        $typeStatement = "SELECT Type from deploymentTable WHERE Version= $max";
                        $types = mysqli_query($conn, $typeStatement);
                        $typeArray = mysqli_fetch_assoc($types);
                        $type = strval($typeArray['Type']);
			echo $type."\n";
			if(trim($lines) == $type && $fallback == 1)
                        {
                                $fileName = "SELECT FileName from deploymentTable WHERE Version = $max";
                                $FileN = mysqli_query($conn, $fileName);
                                $condition = false;
			}
			if(trim($lines) == $type)
			{
				$fallback = 1;
				echo "FallBack!";
			}       
			$max--;
                        sleep(1);
	}while($condition);
                $FileN = mysqli_query($conn, $fileName);
                $FileArray = mysqli_fetch_assoc($FileN);
                $ActualName = strval($FileArray['FileName']);
                //var_dump($FileArray);
                echo $ActualName."\n";


        //exit;
}
echo "\n";
echo "What SCP target would you like to change?";
$handle = fopen("php://stdin","r");
$line = fgets($handle);
if(trim($line) == 'marc@192.168.1.8')
{
	$recipient = trim($line);
        //Enter update code here
	echo "Sending to ".$recipient."\n";
        //exit;
}
$send = "sudo scp deployment/patches/".$vstat." ".$recipient.":/var/www/html/490/Update\n";
echo $send;
exec($send);
echo "\nThank you, continuing... \n";
?>
