<?php
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
       
<form  class="form-inline" method="POST" action="matchmaking.php">

<div class="container">
   <h2> Match Making Page </h2>
   <h3> When you hit start match below you will be randomly paired up with another team and you will vs them </h3>
   <h3> The results will be displayed after </h3>

   <button class="btn btn-lg btn-primary btn-block btn-login" type="submit" ="submit" id="submit">Start Match</button>


</div>
</body>
</html>
