#!/usr/bin/php
<?php
/* Copy and paste following code into mysql when logged into root
 	CREATE USER 'dbAdmin'@'localhost' IDENTIFIED BY 'password123!';
	create database loginDB;
	GRANT ALL PRIVILEGES ON loginDB.* TO 'dbAdmin'@'localhost';
	flush privileges;
 */
/* Copy and paste when logged into dbAdmin
 	use loginDB;
	CREATE TABLE loginTable(username varchar(30), password varchar(30));
	INSERT INTO loginTable VALUES ('peter', '1234');
	SELECT * FROM loginTable;
 
 */
$mydb = new mysqli('127.0.0.1','dbAdmin','password123!','loginDB');

if ($mydb->errno != 0)
{
        echo "failed to connect to database: ". $mydb->error . PHP_EOL;
        exit(0);
}

echo "successfully connected to database".PHP_EOL;

$query = "select * from testTable;";

$response = $mydb->query($query);
if ($mydb->errno != 0)
{
        echo "failed to execute query:".PHP_EOL;
        echo __FILE__.':'.__LINE__.":error: ".$mydb->error.PHP_EOL;
        exit(0);
}

/*CREATE TABLE playerTable(playerID varchar(30), lastName varchar(30), firstName varchar(30), teamID varchar(30), team varchar(30), fieldGoals varchar(30), freethrowAttempt varchar(30), freethrowMade varchar(30), offensiveRebounds varchar(30), defensiveRebounds varchar(30), steals varchar(30), assists varchar(30), blocks varchar(30), fouls varchar(30), turnover varchar(30));
*/

?>
