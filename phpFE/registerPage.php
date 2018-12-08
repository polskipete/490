<?php
   // ini_set('display_startup_errors', true);
   // error_reporting(E_ALL);
   // ini_set('display_errors', true);
   //include('registrationForm.php');
   echo "hello ";
   session_start();
   $_GET['username'];
   echo $_SESSION['username'];
  // include('registrationForm.php');
?>

<!doctype html>

<head>
  <link rel="stylesheet" href="../css/registerpage.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>Registration</title>

</head>


<body>

  <div class="main">
    <p class="sign" align="center"><u>Registration</u></p>
    <p align="center">Please fill in this form to create an account.</p>

     <form action="registrationForm.php" method="post" class="form1">
      <input class="un " type="text" align="center" placeholder="Username" name="inputUser" id="inputUser">
      <input class="pass" type="password" align="center" placeholder="Password" name="inputPassword" id="inputPassword">
      <button class="submit" align="center">Submit</button>
      <p class="forgot" align="center">Already have an account? <a href="loginpage.php">Click Here</p>
    </div>
     
</body>

</html>
