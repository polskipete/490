#!/usr/bin/php
<?php

echo $_SERVER["REQUEST_METHOD"];
registerFunction($_SERVER["REQUEST_METHOD"]);

function registerFunction($Server){
	require_once ('../phpBE/config.php');
	$username = $_POST['inputUser'];
	$password = $_POST['inputPassword'];
	echo $username." userrrr\n";
	$username_err = $password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	//Validation of username
	if(empty(trim($_POST["inputUser"]))){
		echo "test";
		$username_err = "Please enter a username.";
	}else{
		//Select statement
		$sql = "SELECT username FROM loginTable";
		echo "rig";
		if($stmt = mysqli_prepare($conn, $sql)){
			echo "medium";
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			//Parameters
			$param_username = trim($_POST["username"]);
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				if(mysqli_stmt_num_rows($stmt == 1)){
					$username_err = "This username is already taken.";
				}else{
					$username = trim($_POST["username"]);
				}
			}else{
				echo "Hmm. Something went wrong. Please try again later!";
			}
		}
		mysqli_stmt_close($stmt);
	}echo "closer";
	//PASSWORD VALIDATION
	if(empty(trim($_POST["inputPassword"]))){
		$password_err = "Please enter a password.";
	}elseif(strlen(trim($_POST["inputPassword"])) < 6){
		$password_err = "Password must be greater than 6 characters.";
	}else{
		$password = trim($_POST["inputPassword"]);
	}
	
	if(empty($username_err) && empty($password_err)){
		$user = $_POST['inputUser'];
		echo "\nRARARA " . $user; 
		$pass = $_POST['inputPassword'];
		$userID = $_POST[userID];
		$testID = (string)$user;
		echo "\nFINALLY";
		$sql = "INSERT INTO loginTable(username, password, win, loss, draw, money) VALUES ('$user', '$pass', '0', '0', '0', '1000')";
		$sql2 = "UPDATE loginTable SET teamID = userID";
		
		$tableName = "team$testID";
		$historyName = "history$testID";
		$sql3 = "CREATE TABLE ".$tableName."(playerID varchar(30), lastName varchar(30), efficiency varchar(30))";
		$sql4 = "CREATE TABLE ".$historyName."(money int(11), date DATE, loss_win_draw varchar(30), matchID INT AUTO_INCREMENT PRIMARY KEY)";		
		if($stmt = mysqli_query($conn, $sql)){
			mysqli_query($conn, $sql2);
			mysqli_query($conn, $sql3);
			mysqli_query($conn, $sql4);
			mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
			
			$param_username = $username;
			//Hashed password
			$param_password = password_hash($password, PASSWORD_DEFAULT);
			//header('Location: login.php');
		}
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}	
}
	
?>
