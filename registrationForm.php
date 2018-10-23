<?php

require_once ('config.php');

//Empty variable for stored information
$username = $password = "";

//Empty variable for potential error information
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	//Validation of username
	if(empty(trim($_POST["username"]))){
		$username_err = "Please enter a username.";
	}else{
		//Select statement
		$sql = "SELECT username FROM loginTable";
	
		if($stmt = mysqli_prepare($conn, $sql)){
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
	}

	//PASSWORD VALIDATION
	if(empty(trim($_POST["password"]))){
		$password_err = "Please enter a password.";
	}elseif(strlen(trim($_POST["password"])) < 6){
		$password_err = "Password must be greater than 6 characters.";
	}else{
		$password = trim($_POST["password"]);
	}
	

	if(empty($username_err) && empty($password_err)){
		$user = $_POST[username];
		$pass = $_POST[password];
		$sql = "INSERT INTO loginTable(username, password, win, loss, draw, money) VALUES ('$user', '$pass', '0', '0', '0', '1000')";
		$sql2 = "UPDATE loginTable SET teamID = userID";		
		if($stmt = mysqli_query($conn, $sql)){
			mysqli_query($conn, $sql2);
			mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
			
			$param_username = $username;
			//Hashed password
			$param_password = password_hash($password, PASSWORD_DEFAULT);
			
			/*if(mysqli_stmt_execute($stmt)){
				header("location: login.html");
			}else{
				echo "Something went wrong. Try again later."
			}*/
		}
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}	

?>
