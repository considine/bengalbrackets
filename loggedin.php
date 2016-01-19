<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Jack</title>
</head>
<body>
    	<div id="bracket_wrap">
        <?php
        	// x represetns the fight number
        	//First Round Fights
        	$first_round = 8;
        	$total_fights = 15;
        	$round = 1;
        	$starting = 40; //starting distance from top of the screen
        	$iterator = 0;
        	echo '<div class="inline_block">';
        	for($x = 0; $x < $total_fights; $x++) {

        		//define distance from the top
        		//should be plus 80 for each of the first round
        		// plus 160 for the second round (starting at 40)
        		// plus 320 for the second round (starting at 80)
        		$top = $iterator*80*$round;
        		if ($round === 1) {
        			if ($x %2 === 0) {
        				$top += 10;
        			}
        			else {
        				$top -= 10;

        			}
        		}

        		//get top margin
        		else {
        			
        			$top += (pow(2, $round)) * 10;
        		}
		         echo ' 
		         <form action="loggedin.php" method="post" id="fight'. $x.'" class="radio-forms" style="top: '.$top.'px;">
		         	<div class="own_block">
		        	<input type="radio" name="userNumber' .$x.'" value="male' .$x.'" id="male' .$x.'">
		        	<label for="male' .$x.'"> Male </label>
		        	</div>
		        
		        	<div class="own_block">
		        	<input type="radio" name="userNumber' .$x.'" value="female' .$x.'" id="female' .$x.'">
		        	<label for="female' .$x.'"> Female </label>
		        	</div>
		       	 <br>
		        </form>
		        ';
		        $iterator++;
		        if (($x+1)%$first_round == 0) {
		        	//iterate round
		        	$round ++;
		        	$iterator = 0;
		        	$first_round = $first_round / 2;
        			echo '</div>';
        			echo '<div class="inline_block">';
        		}

		    }
		    echo '</div>';
		    echo '</div>';
        ?>
    	</div>
    	<form action="index.php" method ="post" id="myform">
    		<?php 
    			for ($j = 0; $j< $total_fights; $j++) {
    				echo '<input type="hidden" name="fight'.$j.'" id="bout'.$j.'">';
    			}
    		?>
    	</form>
        <button id="total_submit"> GO </button>
        <form action="loggedin.php" method ="post">
	        <label for="boxerName"> Boxername: </label>
			<input type="text" name= "boxer" id="boxerName"/>
			<input type="submit">
		</form>
        <script src="jquery.txt"></script>
		<script>
		console.log("hello");
		$("#total_submit").click(function() {
			var total_fights = "<?php echo $total_fights; ?>";
			// make sure that all games are filled out
			for (i=0; i<total_fights; i++) {
				 var fightWinner = ($('input[name=userNumber'+i.toString() +']:checked', '#fight'+i.toString()).val());
				 if (!fightWinner) {
				 	alert("Please fill in all fights! \nfight not filled out: "+ i.toString());
				 	return;
				 }
				 document.getElementById("fight" + i).value = i.toString();
				 $("#myform").submit();
			}

			// submit all forms
			

		});
		
		</script>
    <?php
    include ("database.php");
    echo "<h1> hello </h1>";
    if(isset($_POST["bout3"])) { //USE HIDDEN FORM
    	echo "<h1> hello </h1>";
    	
    }
    if(isset($_POST["boxer"])) { 

        $boxer_name = $_POST["boxer"];
        session_start();
        $results = $db->prepare("INSERT INTO Fighters(fighterFullname, username, Round) VALUES(?, ?, ?)");
        $results->execute(array($boxer_name, $_SESSION['login'], 1));
    }
    ?>
</body>
</html>


