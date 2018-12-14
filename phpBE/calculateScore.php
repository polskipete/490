#!/usr/bin/php
<?php
function calculateScore($teamName)
{
	
	$servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
	$dbname = "loginDB";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
	$sql = "SELECT efficiency from $teamName";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_all($result);
	//var_dump($row);
	//echo $row[1][0];
	$tableName = $teamName;	
	//$totalscore=0;
	$count= 0;
	$average = 0;
	foreach($row as $playerID)
	{
		$average += $row[$count][0];
		$count++;
	}
	$total = $average/10;
	//echo "\n".$total."\n";
	return $total;
}
?>
