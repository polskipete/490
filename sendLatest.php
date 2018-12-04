#!/usr/bin/php
<?php
include("deployment/dbconfig.php");
echo "Would you like to send your latest update? yes or no?: ";
$recipient = "marce@192.1681.23";
$handle = fopen("php://stdin","r");
$line = fgets($handle);
if(trim($line) == 'yes')
{
	if($conn)
	{
		$versionSQL = "SELECT MAX(Version) FROM deploymentTable";
		$versionArray = mysqli_query($conn, $versionSQL);
		$version = mysqli_fetch_assoc($versionArray);
                $max = intval($version['MAX(Version)']);
		//var_dump($version);
		echo $max."\n";
		$fileName = "SELECT FileName from deploymentTable WHERE Version = $max";
                $FileN = mysqli_query($conn, $fileName);
		$FileArray = mysqli_fetch_assoc($FileN);
                $ActualName = strval($FileArray['FileName']);
		//var_dump($FileArray);
		echo $ActualName."\n";
	}
        //Enter update code here
        echo "Sending to ".$recipient."\n";
	$send = "sudo scp ".$ActualName." ".$recipient.":/var/www/html/490/Update\n";
	echo $send."\n";
	exec($send);
	//exit;
}


?>
