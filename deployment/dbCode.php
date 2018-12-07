#!/usr/bin/php
<?php
	include("dbconfig.php");
	$filename = getFileName();
	addVersion($conn, $filename);

	function addVersion($conn, $filename){
		$time = date('Y-m-d G:i:s');
		$status = "Bad";
		$versionSQL = "SELECT MAX(Version) FROM deploymentTable";
	
		$result = mysqli_query($conn, $versionSQL);
		$countRow = mysqli_fetch_assoc($result);
		var_dump($countRow);		
		$max = intval($countRow['MAX(Version)']);
		$max ++;
		//echo $max;
		$newFileName = createFileName($max, $filename);
		$type = getFileType($filename);
		moveFile($newFileName, $filename);

		$sql = "INSERT INTO deploymentTable(Status, FileName, Type, Date)VALUES ('$status', '$newFileName', '$type', '$time')";
		$result = mysqli_query($conn, $sql);
		
	}
	function createFileName($version, $filename){
		$newFile =  $version . "_" . $filename;
		echo $newFile;
		return $newFile;
	}
	function getFileName(){
		$path = '/var/www/html/490/deployment/patches/transferingPatch';
		$file = array_diff(scandir($path), array('.', '..'));
		echo $file[2];
		if($file[2]==''){exit();}
		return $file[2];	
	}
	function getFileType($filename){
		$fileType = chopFilename($filename);
		return $fileType;
	}
	function chopFilename($filename){
		$round1 = substr ($filename, 0, strrpos($filename,'.'));
		return $round2 = substr ($round1, 0, strrpos($round1,'.'));
	}	
	function moveFile($newFileName, $filename){
		echo "\n" . $filename . "\n";
		echo $newFileName;
		$movePatch = "\n sudo mv /var/www/html/490/deployment/patches/transferingPatch/$filename /var/www/html/490/deployment/patches/$newFileName";
		exec($movePatch);

	}
?>



