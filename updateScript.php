#!/usr/bin/php
<?php 
	$file = fileGetName();
	$destination = transferChop($file);
	transfer($file, $destination);
	extraction($file, $destination);
	function transfer($file, $destination){
		$transfer = "sudo mv Update/$file ./";
		exec($transfer);
	}
	function extraction($file, $destination){
		$extract = "sudo tar -xvf $file -C $destination/";
		exec($extract);
	}
	function transferChop($filename){
		$round1 = substr ($filename, 0, strrpos($filename, '.'));
		$round2 = substr ($round1, 0, strrpos($round1, '.'));
		$round3 = trim(substr($round2, strpos($round2, '_') + 1 ));
		return $round3;
	}
	function fileGetName(){
		$path = 'Update/';
		$file = array_diff(scandir($path), array('.','..'));
		return $file[2];
	}
?>
