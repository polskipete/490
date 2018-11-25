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
	CREATE TABLE deploymentTable(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, version 		VARCHAR(30) NOT NULL, location VARCHAR(30) NOT NULL, date TIMESTAMP);
	SELECT * FROM deploymentTable;
 
	insert into deploymentTable (version, location, date) VALUES ('1.0', 'deployment', 		'2017-07-03');

 	*/
?>
