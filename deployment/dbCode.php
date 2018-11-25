#!/usr/bin/php
<?php
	include("dbconfig.php");
	function chopFilename ($filename){
		$round1 = substr ($filename, 0, strrpos($filename,'.'));
		return $round2 = substr ($round1, 0, strrpos($round1,'.'));
	}
	function addVersion($conn, $version){
		echo $version;
		$time = date('Y-m-d G:i:s');
		echo $time;
		$sql = "INSERT INTO deploymentTable (version, location, date) VALUES 			('$version','deployment', '$time')";
		$add = mysqli_query($conn, $sql);
	}
	
	$filename = "1_0.tar.gz";

	echo chopFilename($filename);
	addVersion($conn, chopFilename($filename));

	
?>



