#!/usr/bin/php
<?php
	function chopFilename ($filename){
		$round1 = substr ($filename, 0, strrpos($filename,'.'));
		return $round2 = substr ($round1, 0, strrpos($round1,'.'));
	}
	
	$filename = "1_0.tar.gz";

	echo chopFilename($filename);

	
?>



