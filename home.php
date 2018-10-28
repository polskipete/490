<?php
	session_start();
?>

<!doctype html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" type="text/css" href="home.css">

<title>Home Page</title>

<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="rostercreation.php">Team Making</a></li>
  <li><a href="matchpage.php">Match Making</a></li>
  <li><a href="history.php">History</a></li>
  <li><a href="logout.php">Log Out</a></li>
</ul> 

</head>



<h2> Hello <?php echo $_SESSION['name'];
 ?> ,... you are a Cunt </h2>

<div class="container">



        
</div>
</body>
</html>

