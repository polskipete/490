<?php
    //include('testRabbitMQServer.php');
    echo "hello ";
    session_start();
    $_GET['username'];
    echo $_SESSION['username'];

?>

<!doctype html>
<head>
<!-- Basics -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Login</title>

    <!-- Style sheets  -->

    <link rel="stylesheet" type="text/css" href="login.css">

<ul>
  <!--<li><a href="reroutetemp.php">Home</a></li>
  <li><a href="reroutetemp.php">Team Making</a></li>
  <li><a href="reroutetemp.php">Match Making</a></li>
  <li><a href="reroutetemp.php">History</a></li>-->
  <li><a href="login.php">Log In</a></li>
</ul>

</head>
<body>
	<form  class="form-inline" method="POST" action="Client.php">
	<div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="https://qph.fs.quoracdn.net/main-qimg-87001d2ce810c2f48c97032cbc905939" style="width:200.67px;height:150.67px; />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-login">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="inputUser" id="inputUser" class="form-control" placeholder="Username" required autofocus>
                <input type="password" name="inputPassword"id="inputPassword" class="form-control" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-login" type="submit" ="submit" id="submit">Log in</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                Forgot the password?
            </a>

            <p>Dont have an account? <a href="registration.php">Register here</a>.</p>

        </div><!-- /card-container -->
    </div><!-- /container -->

</body>

</html>
