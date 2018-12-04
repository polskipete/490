#!/usr/bin/php
<?php
	$servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
        $dbname = "deploymentDB";
        //Try to connect to db and store the results in conn
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        //Comment if DB login was succesful or not
        if(!$conn)
        {
                printf("DB Connection Failed: ".mysqli_connect_error());
        }
        else
        {
                // Now connected to database
                printf("DB Connection Succesful! \n");
             
        }
?>
