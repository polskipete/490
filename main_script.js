
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

        // Close the MainContent with the close button
	function match_close() {
	    myMatchMaking.style.display = "none";
	}

	// Close the MainContent with the close button
	function team_close() {
	    myTeamMaking.style.display = "none";
	}
