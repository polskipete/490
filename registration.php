
<!doctype html>
<?php
    include('registrationForm.php');
?>

<head>
 
    <!-- Basics -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
     
    <title>Registration</title>

    <link rel="stylesheet" type="text/css" href="login.css">

</head>
<body>

<div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
		<label><b>Username</b></label>
		<input type="text" placeholder="Enter Username" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
        </div>    
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label><b>Confirm Password</b></label>
                <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
		<p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>Already have an account? <a href="Login.html">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
