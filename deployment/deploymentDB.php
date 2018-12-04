#!/usr/bin/php
<?php
	/* Copy and paste following code into mysql when logged into root
 	CREATE USER 'dbAdmin'@'localhost' IDENTIFIED BY 'password123!';
	create database deploymentDB;
	GRANT ALL PRIVILEGES ON deploymentDB.* TO 'dbAdmin'@'localhost';
	flush privileges;
	*/
	/* Copy and paste when logged into dbAdmin
 	use deploymentDB;
	CREATE TABLE deploymentTable(Status VARCHAR(30) NOT NULL, Version INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, FileName VARCHAR(30) NOT NULL, Type VARCHAR(30), Date TIMESTAMP);
	SELECT * FROM deploymentTable;
 
	insert into deploymentTable (Status, FileName, Type, Date) VALUES ('Bad', '0.tar.gz', 'html', '2018-07-03');

 	*/
?>
