#!/usr/bin/php

<?php
$username = 'username';
$password = 'password';
$Primary_DB = 'database';
$username2 = 'username2';
$password2 = 'password2';
$HSB_DB = 'database2';

//identify  primary database
echo "Please type primary database name";
$handle = fopen ("php://stdin", "r");
$Primary_DB = fgets($handle);

//establish connect to primary database
$dbConnect = mysqli_connect("localhost", "$username", "$password", "$Primary_DB");
$selectedDB = mysqli_select_db(dbConnect, "$PrimaryDB");

//identify HSB database
echo "Is there a HSB database? Type yes or no. If no, one will be made.";
$handle = fopen ("php://stdin", "r");
$line = fgets($handle);

if(trim($line) == yes)
{

echo "Please type in name of HSB database.";
$handle = fopen ("php://stdin", "r");
$HSB_DB = fgets($handle);

//establish connect to HSB database, if it exist
$dbConnect2 = mysqli_connect("localhost", "$username2", "$password2", "$HSB_DB", true);
$selectedDB2 = mysqli_select_db(dbConnect, "$HSB_DB");

replicate();
}

if (trim($line) == no)
{
freshReplicate(); 
}

//Replicate all tables from Primary Database and Insert into HSB database
function replicate($PrimaryDB, $HSB_DB)
{

$getTables = mysqli_query("SHOW TABLES");
$originalDB = [];
while($row = mysqli_fetch_row($getTables))
{
	$orignialDB[] = $row[0]; 
}

mysqli_query(dbConnect2, "INSERT INTO $HSB_DB_table SELECT * FROM $PrimaryDB_table");

}

// if HSB Database does not exist
function freshReplicate ($PrimaryDB, $HSB_DB) {
$getTables = mysqli_query("SHOW TABLES");
$originalDB = [];
while($row = mysqli_fetch_row($getTables)){
$orignialDB[] = $row[0]; }
mysqli_query("CREATE DATABASE 'newDB'");
foreach(originalDB as $table) {
mysqli_select_db("CREATE TABLE $table LIKE ".$originalDB."",$table);
mysqli_query(dbConnect2, "INSERT INTO $HSB_DB_table SELECT * FROM $PrimaryDB_table");}
}

// close connections
mysqli_close(dbConnect);
mysqli_close(dbConnect2);
?>


