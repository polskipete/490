<?php
    //require_once(testRabbitMQServer.php);
    require_once('config.php');
    echo "hello ";
    session_start();
    $_GET['username'];
    echo $_SESSION['username'];
    $user = $_SESSION['username'];


  $sql = "SELECT win FROM loginTable WHERE username= '$user';";
  $result = mysqli_query($conn, $sql);
  $row1 = mysqli_fetch_all($result);
  //var_dump($row1);
  $win = $row1[0][0];

  $sql = "SELECT lose FROM loginTable WHERE username= '$user';";
  $result2 = mysqli_query($conn, $sql);
  $row1 = mysqli_fetch_all($result2);
  //var_dump($row1);
  $lose = $row1[0][0];
 
  $sql = "SELECT draw FROM loginTable WHERE username= '$user';";
  $result3 = mysqli_query($conn, $sql);
  $row1 = mysqli_fetch_all($result3);
  //var_dump($row1);
  $draw = $row1[0][0];
  
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
   <h3> Wins:  <?php  echo $win;    ?> </h3>
   <h3> Losses: <?php echo  $lose;  ?> </h3>
   <h3> Draws: <?php  echo $draw;  ?> </h3>

</div>

</body>

</html>
