#!/usr/bin/php
<?php
include('../phpBE/config.php');
		$sql = "SELECT efficiency FROM playerTable WHERE playerID = 9522";
		$username = mysqli_query($conn, $sql);
		$userRow = mysqli_fetch_assoc($username);
		//echo "team".$userRow["username"] . "\n\n\n";
		var_dump($userRow);
		echo $userRow['efficiency'];
?>
