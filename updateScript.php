#!/usr/bin/php
<?php 
	$file = fileGetName();
	$destination = transferChop($file);
	transfer($file);
	extraction($file, $destination);
	exec("sudo rm /var/www/html/490/$file");
	function transfer($file){
		//echo $file;
		$transfer = "sudo mv /var/www/html/490/Update/$file /var/www/html/490/";
		exec($transfer);
	}
	function extraction($file, $destination){
		echo $file . "\n" . $destination;
		$extract = "sudo tar -xvf /var/www/html/490/$file -C /var/www/html/490/$destination";
		exec($extract);
	}
	function transferChop($filename){
		$round1 = substr ($filename, 0, strrpos($filename, '.'));
		$round2 = substr ($round1, 0, strrpos($round1, '.'));
		$round3 = trim(substr($round2, strpos($round2, '_') + 1 ));
		return $round3;
	}
	function fileGetName(){
		$path = '/var/www/html/490/Update/';
		$file = array_diff(scandir($path), array('.','..'));
		//echo $file[2];
		if($file[2] == ""){
			exit();
		}
		return $file[2];
	}
?>
