#!/usr/bin/php
<?php
        //Db login Variables
        $servername = "192.168.1.10";
        $username = "dbFail";
        $password = "password123!";
        $dbname = "loginDB";
	$loop=True;
	$count = 0;
do{
	$count++;
        //Try to connect to db and store the results in conn
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        //Comment if DB login was succesful or not
        if(!$conn)
        {
                printf("DB Connection Failed: ".mysqli_connect_error());
		exec("gnome-terminal -e ./Server.php");
		$loop=false;
        }
        else
        {
                // Now connected to database
                echo $count ."\n";
             
        }
sleep(15);
echo ("\n Sleep done")
}while ($loop);
?>

                                
