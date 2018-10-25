#!/usr/bin/php
<?php

include("config.php");
//var_dump( $conn);

//mock data
$username = "jonathan";



$sql = "SELECT userID FROM loginTable WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


do
{
	$randomID = rand(1, 5);
} while($row["userID"] == $randomID);

echo $randomID;
//echo "Result: " . $row['userID'];
		


?>
