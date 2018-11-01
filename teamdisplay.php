<?php
    require_once('rosterconfig.php');
	$player1 = $_POST['player1search'];
	$player2 = $_POST['player2search'];
	$player3 = $_POST['player3search'];
	$player4 = $_POST['player4search'];
	$player5 = $_POST['player5search'];
	$player6 = $_POST['player6search'];
	$player7 = $_POST['player7search'];
	$player8 = $_POST['player8search'];
	$player9 = $_POST['player9search'];
	$player10 = $_POST['player10search'];

	$Team = array($player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8,$player9,$player10);
	
	//put team ID in front of array */

    echo "hello ";
    session_start();
    $_GET['username'];
    echo $_SESSION['username'];
    $user = $_SESSION['username'];
	

?>
<!doctype html>

<head>
 
    <!-- Basics -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
     
    <title>Team Roster Creation</title>

    <link rel="stylesheet" type="text/css" href="login.css">

    <ul>
          <li><a href="home.html">Home</a></li>
          <li><a href="rostercreation.php">Team Making</a></li>
          <li><a href="matchpage.html">Match Making</a></li>
          <li><a href="history.html">History</a></li>
          <li><a href="login.html">Log Out</a></li>
    </ul> 
</head>

<body>

<div class="container" style="text-align: center">

<h2> Your Team </h2>
<hr>

<?php 
    $tableName = "team$user";
    //echo $tableName;
    echo "\n";
  $sql = "SELECT lastName from $tableName";
  $result = mysqli_query($conn, $sql);
  $row1 = mysqli_fetch_all($result);
  //var_dump($row1);
  $count=0;
  $count2=1;
  foreach($row1 as $value){
  	echo $count2." ".$row1[$count][0];
?> <br> <?php 
	$count++;
        $count2++;
        }
?>	


</div></div>
