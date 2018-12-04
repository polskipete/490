#!/usr/bin/php
<?php

	//get from .json?
	echo "Type In Version Number\n";
	$version = readline("Version Number: ");
	readline_add_history($version);
	$compression = "sudo tar -czvf '$version'.tar.gz /var/www/html/490/html";
	createTAR($compression, $version);

	function createTAR($compression, $version)
	{
		exec($compression);
		// call sending funcion that takes $version as a parameter 
	}
	/*function openJson(){
		
	}
	// create function to send $version.tar.gz through mq
	*/
?>
