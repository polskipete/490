<?php

require_once ('config.php');

//Empty variable for stored information
$username = $password = $confirm_password = "";

//Empty variable for potential error information
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"{
	//Validation of username
	if(empty(trim($_POST["username"]))){
		$username_err = "Please enter a username.";
	}else{
		//Select statement
		$sql = "SELECT id FROM dbAdmin WHERE username = ?";

		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $param_username);

			//Parameters
			$param_username = trim($_POST["username"]);

			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt == 1){
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
	//PASSWORD CONFIRMATION VALIDATION
	if(empty(trim($_POST["confirm_password"]))){
                $confirm_password_err = "Please confirm your password.";
	}else{
		$confirm_password = trim($_POST["confirm_passsword"]);
		if(empty($password_err) && (password != $confirm_password)){
			$confirm_password_err = "Password did not match.";
		}
	}

	if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

		$sql = "INSERT INTO loginTable (username, password) VALUES (?, ?)";

		if($stmt = mysqli_prepare($Link, $sql)){
			mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

			$param_username = $username;
			//Hashed password
			$param_password = password_hash($password, PASSWORD_DEFAULT);

			if(mysqli_stmt_execute($stmt)){
				header("location: login.html");
			}else{
				echo "Something went wrong. Try again later.";
			}
		}
		mysqli_stmt_close($stmt);
	}
	mysqli_close($link);
}	

?>
