
<!doctype html>
<?php
   // ini_set('display_startup_errors', true);
   // error_reporting(E_ALL);
   // ini_set('display_errors', true);
include('registrationForm.php');
echo "hello ";
    session_start();
    $_GET['username'];
    echo $_SESSION['username'];

?>

<head>
 
    <!-- Basics -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
     
    <title>Registration</title>

   

    <ul>
  <!--<li><a href="reroutetemp.php">Home</a></li>
  <li><a href="reroutetemp.php">Team Making</a></li>
  <li><a href="reroutetemp.php">Match Making</a></li>
  <li><a href="reroutetemp.php">History</a></li>-->
  <li><a href="registration.php">Register Here</a></li>
</ul>

</head>

