#!/usr/bin/php
<?php

        //Db login Variables
        $servername = "localhost";
        $username = "dbAdmin";
        $password = "password123!";
        $dbname = "loginDB";

	$test[0] = "12345";
	$test[1] = "Van Gundy";
	$test[2] = "Stan";
	$test[3] = "88";
        $test[4] = "DET";
        $test[5] = "0";
        $test[6] = "0";
        $test[7] = "0";
        $test[8] = "0";
        $test[9] = "0";
        $test[10] = "0";
	$test[11] = "0";
        $test[12] = "0";
        $test[13] = "2";
        $test[14] = "0";




        //Try to connect to db and store the results in conn
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        //Comment if DB login was succesful or not
        if(!$conn)
        {
                 die("Connection failed: " . mysqli_connect_error());
        }
        else
	{
		$playerID = mysqli_real_escape_string($conn, $test[0]);
		$firstname = mysqli_real_escape_string($conn, $test[2]);
		$lastname = mysqli_real_escape_string($conn, $test[1]);
		$teamID = mysqli_real_escape_string($conn, $test[3]);
                $team = mysqli_real_escape_string($conn, $test[4]);
                $fieldGoals = mysqli_real_escape_string($conn, $test[5]);
                $freethrowAttempt = mysqli_real_escape_string($conn, $test[6]);
                $freethrowMade = mysqli_real_escape_string($conn, $test[7]);
                $offensiveRebounds = mysqli_real_escape_string($conn, $test[8]);
                $defensiveRebounds = mysqli_real_escape_string($conn, $test[9]);
                $steals = mysqli_real_escape_string($conn, $test[10]);
                $assists = mysqli_real_escape_string($conn, $test[11]);
                $blocks = mysqli_real_escape_string($conn, $test[12]);
                $fouls = mysqli_real_escape_string($conn, $test[13]);
                $turnover = mysqli_real_escape_string($conn, $test[14]);
                

		$sql = "INSERT INTO playerTable(playerID, lastName, firstName, teamID, team, fieldGoals, freethrowAttempt, freethrowMade, offensiveRebounds, defensiveRebounds, steals, assists, blocks, fouls, turnover) VALUES('$playerID', '$lastname', '$firstname', '$teamID', '$team', '$fieldGoals', '$freethrowAttempt', '$freethrowMade', '$offensiveRebounds', '$defensiveRebounds', '$steals', '$assists', '$blocks', '$fouls', '$turnover')";
                if(mysqli_query($conn, $sql))
                {
                        echo "New record created";
                }       
                else
                {
                        echo "Error: ".$sql."<br>".mysqli_error($conn);
                }
        }  

?>
