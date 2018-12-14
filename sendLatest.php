#!/usr/bin/php
<?php
echo "Would you like to send your latest update? yes or no?: ";
$recipient = "marce@192.168.1.23";
$handle = fopen("php://stdin","r");
$line = fgets($handle);
if(trim($line) == 'yes')
{
	include 'versionCompression.php';
	echo "Compression executed\n";
        echo "Sending to ".$recipient."\n";
	$send = "sudo scp  Update/".$version.".tar.gz ".$recipient.":/var/www/html/490/deployment/patches/transferingPatch";
	echo $send."\n";
	exec($send);
	//exit;
}
?>
