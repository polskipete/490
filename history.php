<?php
    //require_once(testRabbitMQServer.php);
    echo "hello ";
    session_start();
    $_GET['username'];
    echo $_SESSION['username'];

?>

<!doctype html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" type="text/css" href="home.css">

<title>Match Page</title>

<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="rostercreation.php">Team Making</a></li>
  <li><a href="matchpage.php">Match Making</a></li>
  <li><a href="history.php">History</a></li>
  <li><a href="logout.php">Log Out</a></li>
</ul>

</head>
<body>

<form  class="form-inline" method="POST" action="testRabbitMQClient.php">

<div class="container">
   <h2> History </h2>
   <h3> Below is your Cummulative History </h3>
   <h3> Wins:  <?php       ?> </h3>
   <h3> Losses: <?php     ?> </h3>

</div>

</body>

</html>
