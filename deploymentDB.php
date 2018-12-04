#!/usr/bin/php
<?php

	$servername = "localhost";
	$username = "username";
	$password = "password";
	
	$conn = mysqli_connect$servername, $username, $password);
	
	function createTable()
	{
		if(!$conn)
		{
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "CREATE DATABASE myDB";
		if(mysqli_query($conn, $sql)){
			echo "Database created successfully";
		} else{
			echo "Error creating database: " . mysqli_error($conn);
		}

		mysqli_close ($conn);
	}

?>
