<?php

	$servername = "localhost";
	$username = "dbAdmin";
	$password = "password123!";
	$dbname = "loginDB";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if(!$conn)
	{
		printf("DB Connection Failed: ".mysqli_connect_error());

	}
	else
	{
		printf("DB Connection Yes! \n ");
	}

?>