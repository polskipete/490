#!/usr/bin/php
<?php

	$version = "1_0";
	$compression = "sudo tar -czvf '$version'.tar.gz /var/www/html/490";
	function createTAR($compression)
	{
		exec($compression);
	}
	createTAR($compression);

?>
