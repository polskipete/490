<?php
    require_once('config.php');
    echo "hello ";
    session_start();
    $_GET['username'];
    echo $_SESSION['username'];
    $user = $_SESSION['username'];

    $sql = "SELECT money FROM loginTable WHERE username= '$user';";
    $result = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_all($result);
    //var_dump($row1);
    $money = $row1[0][0];

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



<h2> Welcome <?php echo $_SESSION['name'];
 ?> to our fantasy basketball league!</h2>


<div class="container">

	<h3> You currently have <?php echo $money; ?> Buckaroos </h3>

        
</div>
</body>
</html>

