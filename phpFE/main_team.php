<!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Team Making</b></h5>
  </header> 

  <form class="form-inline" method="post" action="buildTeams.php">


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

	    <div>
		<button class="pure-button pure-button-primary" type="submit" name="submit" id="submit">Submit</button>
	    </div>
	</div>
