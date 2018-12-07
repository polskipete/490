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

?>
<!DOCTYPE html>
<html>
<title>Alpaca Cohorts Fantasy League</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="popupbox.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-dark-grey">

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
      <img src="profile_img1.jpg" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar"><br>
      <span>Welcome, <strong> <?php echo $_SESSION['name']; ?>
      </strong></span><br><span>You have <strong> <?php echo $money; ?></strong> Buckaroos </span><br><br>
    </div>
  </div>
  <hr>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue" onclick="team_close(); match_close(); main_open()"><i class="fa fa-  fa-fw"></i> Home Page</a>
    <a href="#" class="w3-bar-item w3-button w3-padding" onclick="main_close(); team_close(); match_open()"><i class=" "></i>    Match Making </a>
    <a href="#" class="w3-bar-item w3-button w3-padding" onclick="main_close(); match_close(); team_open()"><i class=" "></i>    Team Making</a>
    <a href="#" class="w3-bar-item w3-button w3-padding w3-red" onclick="main_close(); match_close(); team_close(); "><i class=" " id="myLogOutBtn"></i>    Log Out</a>
    <!--<a href="#" class="w3-bar-item w3-button w3-padding"><i class=" "></i>    Team Display</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class=" "></i>    History</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class=" "></i>    Setting</a>-->
    <br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<!-- -------------------------------------------------------------------------------------------------------------------Main Content Page START-->

<div class="w3-main" style="margin-left:300px;margin-top:43px;" id="myMainContent">

   <?php include('main_main.php'); ?>

</div>

<!-- -------------------------------------------------------------------------------------------------------------------Main Content Page END-->

<!-- -------------------------------------------------------------------------------------------------------------------Team Making Page START-->

<div class="w3-main" style="margin-left:300px;margin-top:43px;" id="myTeamMaking">

  <?php include('main_team.php'); ?>

</div>

<!-- -------------------------------------------------------------------------------------------------------------------Team Making Page END-->

<!-- -------------------------------------------------------------------------------------------------------------------Match Making Page START-->

<div class="w3-main" style="margin-left:300px;margin-top:43px;" id="myMatchMaking">
  
  <?php include('main_match.php'); ?>

</div>

<!-- -------------------------------------------------------------------------------------------------------------------Match Making Page END-->

<script>
	// Get the Sidebar and MainContent
	var mySidebar = document.getElementById("mySidebar");
	var myMainContent = document.getElementById("myMainContent");
	var myMatchMaking = document.getElementById("myMatchMaking");
	var myTeamMaking = document.getElementById("myTeamMaking");

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


</script>
</body>
</html>
