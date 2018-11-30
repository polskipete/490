#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

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
	$vstat = "2_0.tar.gz";
	//exit;
}
if(trim($line) == 'rollback')
{
	//Enter rollback code here
	echo "Rolling back!\n";
	$vstat = "1_0.tar.gz";
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
$send = "sudo scp ".$vstat." ".$recipient.":patches/transferingPatch\n";
echo $send;
exec($send);
echo "\nThank you, continuing... \n";




?>
