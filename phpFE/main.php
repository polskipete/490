<?php
    require_once('../phpBE/config.php');
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
    
    $sql = "SELECT win FROM loginTable WHERE username= '$user';";
    $result1 = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_all($result1);
    //var_dump($row1);
    $win = $row1[0][0];

    $sql = "SELECT loss FROM loginTable WHERE username= '$user';";
    $result2 = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_all($result2);
    //var_dump($row1);
    $loss = $row1[0][0];
 
    $sql = "SELECT draw FROM loginTable WHERE username= '$user';";
    $result3 = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_all($result3);
    //var_dump($row1);
    $draw = $row1[0][0];
    
    $win = $_SESSION['win'];
    $loss = $_SESSION['loss'];
    $draw = $_SESSION['draw'];
    $total = ($win + $loss + $draw);

    include('rosterconfig.php');

    $sql = "SELECT *  from playerTable";
    $result4 = mysqli_query($conn, $sql);
    $result5 = mysqli_query($conn, $sql);
    $result6 = mysqli_query($conn, $sql);
    $result7 = mysqli_query($conn, $sql);
    $result8 = mysqli_query($conn, $sql);
    $result9 = mysqli_query($conn, $sql);
    $result10 = mysqli_query($conn, $sql);
    $result11 = mysqli_query($conn, $sql);
    $result12 = mysqli_query($conn, $sql);
    $result13 = mysqli_query($conn, $sql);

    if(empty($_SESSION["player1"]))
    {
	$_SESSION["player1"] = "Team Player 1";
    } elseif(empty($_SESSION["player1"])){
	$_SESSION["player2"] = "Team Player 2";
    } elseif(empty($_SESSION["player1"])){
	$_SESSION["player3"] = "Team Player 3";
    } elseif(empty($_SESSION["player1"])){
	$_SESSION["player4"] = "Team Player 4";
    } elseif(empty($_SESSION["player1"])){
	$_SESSION["player5"] = "Team Player 5";
    } elseif(empty($_SESSION["player1"])){
	$_SESSION["player6"] = "Team Player 6";
    } elseif(empty($_SESSION["player1"])){
	$_SESSION["player7"] = "Team Player 7";
    } elseif(empty($_SESSION["player1"])){
	$_SESSION["player8"] = "Team Player 8";
    } elseif(empty($_SESSION["player1"])){
	$_SESSION["player9"] = "Team Player 9";
    } elseif(empty($_SESSION["player1"])){
	$_SESSION["player10"] = "Team Player 10";
    }

?>
<!DOCTYPE html>
<html>
<title>Alpaca Cohorts Fantasy League</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-black">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-blue" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">Alpaca Cohort</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <br>
      <img src="blank-profile-picture-png-8.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar"><br>
      <span>Welcome, <strong> <?php echo $_SESSION['name']; ?>
      </strong></span><br><span>You have <strong> <?php echo $money; ?></strong> Buckaroos </span><br><br>
    </div>
  </div>
  <hr>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>

    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue" onclick="team_close(); match_close(); history_close(); list_close(); tutorial_close(); main_open()"><i class="fa fa-  fa-fw"></i>Home Page</a>

    <a href="#" class="w3-bar-item w3-button w3-padding" onclick="main_close(); match_close(); tutorial_close(); history_close(); list_close(); team_open()"><i class=" "></i>    Team Making</a>

    <a href="#" class="w3-bar-item w3-button w3-padding" onclick="main_close(); team_close(); tutorial_close(); history_close(); list_close(); match_open()"><i class=" "></i>    Match Making</a>

    <a href="#" class="w3-bar-item w3-button w3-padding" onclick="main_close(); team_close(); tutorial_close(); match_close(); list_close(); history_open();"><i class=" "></i>    History</a>

    <a href="#" class="w3-bar-item w3-button w3-padding w3-red" onclick='location.href="/490/phpFE/loginpage.php"'><i class=" "></i>    Log Out</a>

    <a href="#" class="w3-bar-item w3-button w3-padding w3-Pale-Blue" onclick="main_close(); match_close(); team_close(); history_close(); list_close(); tutorial_open()"><i class=" "></i> Need Help? Click for Tutorial </a>

    <a href="#" class="w3-bar-item w3-button w3-padding w3-light-grey" onclick="main_close(); match_close(); team_close(); history_close(); tutorial_close(); list_open();"><i class=" "></i> Don't know what players are in the league? <br> 	Click for full list </a>

    <!--<a href="#" class="w3-bar-item w3-button w3-padding"><i class=" "></i>    Setting</a>-->
    <br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE MAIN CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;" id="myMainContent">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header> 

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa- w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php  echo $win;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Wins</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-  w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo  $loss;  ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Losses</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-  w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo  $draw; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Draws</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-  w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo  $total; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total</h4>
      </div>
    </div>
  </div>

  <!-- !CURRENT TEAM SECTION! -->
  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-container">
        <h5>Current Team:</h5>
        <table class="w3-table w3-striped w3-white">
          <tr>
            <td><?phpecho $_SESSION["player1"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player2"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player3"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player4"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player5"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player6"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player7"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player8"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player9"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player10"];?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  
  <br>
  
   
  <!-- Footer -->
  <!--<footer class="w3-container w3-padding-6 w3-black">
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>-->

  <!-- End MAIN page content -->
</div>
<!-- -------------------------------------------------------------------------------------------------------------------Next Page
<!-- !PAGE TEAM MAKING CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;" id="myTeamMaking">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Team Making</b></h5>
  </header> 

  <form class="form-inline" method="post" action="../phpBE/buildTeams.php">

	<div class="w3-container">
	    <h1>Team Selection</h1>
	    <div id="player1searchbox">
		  <label>Player 1 :
		  	<select name="player1search">
		  	<?php while($row1 = mysqli_fetch_array($result4)):;?>
		  	<option value="<?php echo $row1[0];?>">
		        	 <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
		  	<?php endwhile;?>
		 	 </select>
		  </label>
	    </div>

	    <div id="player2searchbox">
		 <label>Player 2 : 
		        <select name="player2search">
		        <?php while($row1 = mysqli_fetch_array($result5)):;?>
		        <option value="<?php echo $row1[0];?>">
		                 <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
		        <?php endwhile;?>
		         </select>
		  </label>
	    </div>

	    <div id="player3searchbox">
		 <label>Player 3 :
		        <select name="player3search">
		        <?php while($row1 = mysqli_fetch_array($result6)):;?>
		        <option value="<?php echo $row1[0];?>">
		                 <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
		        <?php endwhile;?>
		         </select>
		  </label>
	    </div>
	    <div id="player4searchbox">
		 <label>Player 4 :
		        <select name="player4search">
		        <?php while($row1 = mysqli_fetch_array($result7)):;?>
		        <option value="<?php echo $row1[0];?>">
		                 <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
		        <?php endwhile;?>
		         </select>
		  </label>
	    </div>
	    <div id="player5searchbox">
		 <label>Player 5 :
		        <select name="player5search">
		        <?php while($row1 = mysqli_fetch_array($result8)):;?>
		        <option value="<?php echo $row1[0];?>">
		                 <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
		        <?php endwhile;?>
		         </select>
		  </label>
	    </div>
	    <div id="player6searchbox">
		 <label>Player 6 :
		        <select name="player6search">
		        <?php while($row1 = mysqli_fetch_array($result9)):;?>
		        <option value="<?php echo $row1[0];?>">
		                 <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
		        <?php endwhile;?>
		         </select>
		  </label>
	    </div>
	    <div id="player7searchbox">
		 <label>Player 7 :
		        <select name="player7search">
		        <?php while($row1 = mysqli_fetch_array($result10)):;?>
		        <option value="<?php echo $row1[0];?>">
		                 <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
		        <?php endwhile;?>
		         </select>
		  </label>
	    </div>
	    <div id="player8searchbox">
		 <label>Player 8 :
		        <select name="player8search">
		        <?php while($row1 = mysqli_fetch_array($result11)):;?>
		        <option value="<?php echo $row1[0];?>">
		                 <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
		        <?php endwhile;?>
		         </select>
		  </label>
	    </div>
	    <div id="player9searchbox">
		 <label>Player 9 :
		        <select name="player9search">
		        <?php while($row1 = mysqli_fetch_array($result12)):;?>
		        <option value="<?php echo $row1[0];?>">
		                 <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
		        <?php endwhile;?>
		         </select>
		  </label>
	    </div>
	    <div id="player10searchbox">
		 <label>Player 10:
		        <select name="player10search">
		        <?php while($row1 = mysqli_fetch_array($result13)):;?>
		        <option value="<?php echo $row1[0];?>">
		                 <?php echo $row1[2]; echo " "; echo $row1[1]?> </option>
		        <?php endwhile;?>
		         </select>
		  </label>
	    </div>
		<br>
	    <div>
		<button class="pure-button pure-button-primary" type="submit" name="submit" id="submit">Submit</button>
	    </div>
	</div>
	</form>
</div>

<!-- -------------------------------------------------------------------------------------------------------------------Match Making Page-->
<!-- !PAGE MATCH MAKING CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;" id="myMatchMaking">
  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Match Making</b></h5>
  </header> 
         
  <form  class="form-inline" method="POST" action="../phpBE/matchmaking.php">

  <div class="w3-container">
       <h3> When you hit start match below you will be randomly paired up with another team and you will vs them </h3>
       <h3> The results will be displayed on the next page </h3>
       <h3> Your Current Team Efficiency: 444 </h3>
       <button class="btn btn-lg btn-primary btn-block btn-login" type="submit" name="submit" id="submit">Start Match</button>
  </div>
</form>
</div>
<!-------------------------------------------------------------------------------------------------------------------History-->
<!-- !HISTORY! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;" id="myHistory">
  <!-- !MATCH HISTORY PAGE! -->
  <div class="w3-panel">
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My History</b></h5>
  </header> 
      <div class="w3-container">
        <table class="w3-table w3-striped w3-white">
          <tr>
            <td><?phpecho $_SESSION["result"];?></td>
	    <td><?phpecho $_SESSION[""];?></td>
	    <td><?phpecho $_SESSION["player1"];?></td>
	    <td><?phpecho $_SESSION["player1"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player2"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player3"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player4"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player5"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player6"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player7"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player8"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player9"];?></td>
          </tr>
          <tr>
            <td><?phpecho $_SESSION["player10"];?></td>
          </tr>
        </table>
      </div>
    </div>
</div>


<!-------------------------------------------------------------------------------------------------------------------Tutorial Page-->
<!-- !TUTORIAL PAGE! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;" id="myTutorial">
  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Tutorial Section</b></h5>
  </header> 
 
  <div class="w3-container">
       <h2>
	          1. You’ve been gifted with 1,000 coins, please go purchase your team on the Team Making Tab.
	     <br> 2. Once you create your team and go back to the home page you will see your team and efficency displayed. 
	     <br> 3. At the top of the home page tab then you will see you current count for wins, losses, and draws. 
	     <br> 4. If you go to the matchmaking page to verse another team. Your new results will be displayed. 
	     <br> 5. To log out just hit the red logout button on the main screen.
	     <br> 6. We hope you enjoyed our fantasy web app, thank you. </h2>
</div>
</div>

<!-------------------------------------------------------------------------------------------------------------------NBA Player List-->
<!-- !List PAGE! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;" id="myList">
  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> NBA Players</b></h5>
  </header> 
 
  <div class="w3-container">
       <h2>
	    NBA TEAM LIST HERE
				 </h2>
</div>
</div>

<!-------------------------------------------------------------------------------------------------------------------Scripts-->

<script>
	// Get the Sidebar and MainContent
	var mySidebar = document.getElementById("mySidebar");
	var myMainContent = document.getElementById("myMainContent");
	var myMatchMaking = document.getElementById("myMatchMaking");
	var myTeamMaking = document.getElementById("myTeamMaking");
	var myHistory = document.getElementById("myHistory");
	var myTutorial = document.getElementById("myTutorial");
	var myList = document.getElementById("myList");



	// Get the DIV with overlay effect
	var overlayBg = document.getElementById("myOverlay");
        
        //------------------------------------------------------------------------------------------------


	// Toggle between showing and hiding the sidebar, and add overlay effect
	function w3_open() {
	    if (mySidebar.style.display === 'block') {
		mySidebar.style.display = 'none';
		overlayBg.style.display = "none";
	    } else {
		mySidebar.style.display = 'block';
		overlayBg.style.display = "block";
	    }
	}
        
	// Toggle between showing and hiding the maincontent
	function main_open() {
	    myMainContent.style.display = 'block';
	}

	// Toggle between showing and hiding the MatchMaking
	function match_open() {
	    myMatchMaking.style.display = 'block';
	}

	// Toggle between showing and hiding the TeamMaking
	function team_open() {
	    myTeamMaking.style.display = 'block';
	}

	// Toggle between showing and hiding the History
	function history_open() {
	    myHistory.style.display = 'block';
	}

	// Toggle between showing and hiding the Tutorial
	function tutorial_open() {
	    myTutorial.style.display = 'block';
	}
	
	// Toggle between showing and hiding the Tutorial
	function list_open() {
	    myList.style.display = 'block';
	}
	
        //------------------------------------------------------------------------------------------------

	// Close the sidebar with the close button
	function w3_close() {
	    mySidebar.style.display = "none";
	    overlayBg.style.display = "none";
	}

	// Close the MainContent with the close button
	function main_close() {
	    myMainContent.style.display = "none";
	}

        // Close the MatchMaking with the close button
	function match_close() {
	    myMatchMaking.style.display = "none";
	}

	// Close the TeamMaking with the close button
	function team_close() {
	    myTeamMaking.style.display = "none";
	}

	// Close the TeamMaking with the close button
	function history_close() {
	    myHistory.style.display = "none";
	}

	// Close the Tutorial with the close button
	function tutorial_close() {
	    myTutorial.style.display = "none";
	}
	
	// Close the Tutorial with the close button
	function list_close() {
	    myList.style.display = "none";
	}
</script>
</body>
</html>

