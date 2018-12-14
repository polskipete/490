#!/usr/bin/php
<?php
	//get from .json
	echo "Which version would you like to compress?";
	$version = readline("html, phpBE, or phpFE: ");
	readline_add_history($version);
	if($version == "html")
	{
	        $compression = "sudo tar -czvf Update/'$version'.tar.gz /var/www/html/490/html";
	}
        if($version == "phpBE")
        {
                $compression = "sudo tar -czvf Update/'$version'.tar.gz /var/www/html/490/phpBE";
	}
        if($version == "phpFE")
        {
                $compression = "sudo tar -czvf Update/'$version'.tar.gz /var/www/html/490/phpFE";
        }
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
