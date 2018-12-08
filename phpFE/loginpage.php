<?php
    //include('testRabbitMQServer.php');
    echo "hello ";
    session_start();
    $username = $_GET['username'];
    echo $_SESSION['username'];
?>

<!doctype html>

<head>
  <link rel="stylesheet" href="../css/loginpage.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>Sign in</title>
</head>

<body>
  <div class="main">
    <p class="sign" align="center"><u>Sign in</u></p>
    <form  class="form1" method="POST" action="../phpFE/Client.php">
      <input class="un " type="text" name="inputUser" id="inputUser align="center" placeholder="Username" required autofocus>
      <input class="pass" type="password" align="center" placeholder="Password" name="inputPassword" id="inputPassword" required>
      <button class="submit" align="center" type="submit" id="submit">Submit</button>
      <p class="forgot" align="center">Don't have an account? <a href="registerPage.php">Click Here</p>
            
                      
    </div>
     
</body>

</html>


