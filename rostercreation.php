<?php
	session_start();
	include('rosterconfig.php');

        $sql = "SELECT *  from playerTable";
	$result = mysqli_query($conn, $sql);
	$result2 = mysqli_query($conn, $sql);
	$result3 = mysqli_query($conn, $sql);
	$result4 = mysqli_query($conn, $sql);
	$result5 = mysqli_query($conn, $sql);
	$result6 = mysqli_query($conn, $sql);
	$result7 = mysqli_query($conn, $sql);
	$result8 = mysqli_query($conn, $sql);
	$result9 = mysqli_query($conn, $sql);
	$result10 = mysqli_query($conn, $sql);

    //$row = mysqli_fetch_row($result);

    //echo $row[0];
    //echo $row[1];
    //echo $row[2];
	
   //You'd put this code at the top of any "protected" page you create
   //Always start this first
   
   //session_start();

   //if ( isset( $_SESSION['user_id'] ) ) {
      // Grab user data from the database using the user_id
      // Let them access the "logged in only" pages
   //} else {
      // Redirect them to the login page
     // header("Location: http://127.0.0.1/490/login.html");
   //}
	echo "Welcome ";
	echo $_SESSION['username'];
?>

<!doctype html>

<head>
 
    <!-- Basics -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
     
    <title>Team Roster Creation</title>

    <link rel="stylesheet" type="text/css" href="login.css">

    <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="rostercreation.php">Team Making</a></li>
          <li><a href="matchpage.php">Match Making</a></li>
          <li><a href="history.php">History</a></li>
          <li><a href="logout.php">Log Out</a></li>
    </ul> 
</head>
<body>

<form class="form-inline" method="post" action="buildTeams.php">


<div class="container">
    <h1>Team Selection</h1>
    <div id="player1searchbox">
          <label>Player 1:
          	<select name="player1search">
          	<?php while($row1 = mysqli_fetch_array($result)):;?>
	  	<option value="<?php echo $row1[0];?>">
                	 <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
	  	<?php endwhile;?>
	 	 </select>
          </label>
    </div>

    <div id="player2searchbox">
         <label>Player 2:
                <select name="player2search">
                <?php while($row1 = mysqli_fetch_array($result2)):;?>
                <option value="<?php echo $row1[0];?>">
                         <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
                <?php endwhile;?>
                 </select>
          </label>
    </div>

    <div id="player3searchbox">
         <label>Player 3:
                <select name="player3search">
                <?php while($row1 = mysqli_fetch_array($result3)):;?>
                <option value="<?php echo $row1[0];?>">
                         <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
                <?php endwhile;?>
                 </select>
          </label>
    </div>
    <div id="player4searchbox">
         <label>Player 4:
                <select name="player4search">
                <?php while($row1 = mysqli_fetch_array($result4)):;?>
                <option value="<?php echo $row1[0];?>">
                         <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
                <?php endwhile;?>
                 </select>
          </label>
    </div>
    <div id="player5searchbox">
         <label>Player 5:
                <select name="player5search">
                <?php while($row1 = mysqli_fetch_array($result5)):;?>
                <option value="<?php echo $row1[0];?>">
                         <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
                <?php endwhile;?>
                 </select>
          </label>
    </div>
    <div id="player6searchbox">
         <label>Player 6:
                <select name="player6search">
                <?php while($row1 = mysqli_fetch_array($result6)):;?>
                <option value="<?php echo $row1[0];?>">
                         <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
                <?php endwhile;?>
                 </select>
          </label>
    </div>
    <div id="player7searchbox">
         <label>Player 7:
                <select name="player7search">
                <?php while($row1 = mysqli_fetch_array($result7)):;?>
                <option value="<?php echo $row1[0];?>">
                         <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
                <?php endwhile;?>
                 </select>
          </label>
    </div>
    <div id="player8searchbox">
         <label>Player 8:
                <select name="player8search">
                <?php while($row1 = mysqli_fetch_array($result8)):;?>
                <option value="<?php echo $row1[0];?>">
                         <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
                <?php endwhile;?>
                 </select>
          </label>
    </div>
    <div id="player9searchbox">
         <label>Player 9:
                <select name="player9search">
                <?php while($row1 = mysqli_fetch_array($result9)):;?>
                <option value="<?php echo $row1[0];?>">
                         <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
                <?php endwhile;?>
                 </select>
          </label>
    </div>
    <div id="player10searchbox">
         <label>Player 10:
                <select name="player10search">
                <?php while($row1 = mysqli_fetch_array($result10)):;?>
                <option value="<?php echo $row1[0];?>">
                         <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
                <?php endwhile;?>
                 </select>
          </label>
    </div>
    <hr>
    <div>
        <button class="pure-button pure-button-primary" type="submit" name="submit" id="submit">Submit</button>
    </div>
</div>
	

