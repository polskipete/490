<?php
require_once ('../phpBE/config.php');
echo $_SERVER["REQUEST_METHOD"];
registerFunction($_SERVER["REQUEST_METHOD"]);
function registerFunction($Server){
	
	//header('Location: registationForm.php');
	//Empty variable for stored information
	$username = $password = "";

	//Empty variable for potential error information
	$username_err = $password_err = "";
	echo "fig";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	echo "fag";
	var_dump($_POST);
		//Validation of username
		if(empty(trim($_POST["username"]))){
			echo "Hag";
			$username_err = "Please enter a username.";
		}else{
			echo "Bag";
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
		
<<<<<<< HEAD

		if(empty($username_err) && empty($password_err)){
			$user = $_POST[username];
			$pass = $_POST[password];
			$userID = $_POST[userID];
			$testID = (string)$user;
			echo "Fcuk";
			$sql = "INSERT INTO loginTable(username, password, win, loss, draw, money) VALUES ('$user', '$pass', '0', '0', '0', '1000')";
			$sql2 = "UPDATE loginTable SET teamID = userID";
=======
		$tableName = "team$testID";
		$tableName2 = "history$username";
		$sql3 = "CREATE TABLE ".$tableName."(playerID varchar(30), lastName varchar(30), efficiency varchar(30))";
		$sql4 = "CREATE TABLE ".$tableName2."(money int(11), lossOrGain varchar(30), date DATE)";		
		if($stmt = mysqli_query($conn, $sql)){
			mysqli_query($conn, $sql2);
			mysqli_query($conn, $sql3);
			mysqli_query($conn, $sql4);
			mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
>>>>>>> eb73f1207350989dc16801482cf90fdf78d734bc
			
			$tableName = "team$testID";
			$sql3 = "CREATE TABLE ".$tableName."(playerID varchar(30), lastName varchar(30), efficiency varchar(30))";		
			if($stmt = mysqli_query($conn, $sql)){
				mysqli_query($conn, $sql2);
				mysqli_query($conn, $sql3);
				mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
				
				$param_username = $username;
				//Hashed password
				$param_password = password_hash($password, PASSWORD_DEFAULT);
				header('Location: login.php');
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}	
}
?>
