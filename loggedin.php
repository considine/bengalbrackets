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
        	echo '<div class="inline_block">';
        	for($x = 0; $x < $total_fights; $x++) {
        		
		         echo ' 
		         <form action="loggedin.php" method="post" id="fight'. $x.'">
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
		        if (($x+1)%$first_round == 0) {
		        	
		        	$first_round = $first_round / 2;
        			echo '</div>';
        			echo '<div class="inline_block">';
        		}
		    }
		    echo '</div>';
		    echo '</div>';
        ?>
    	</div>
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
			}

			// submit all forms
			for (i=0; i<total_fights; i++) {
				$('form#fight'+i.toString()).submit();
			}

		});
		
		</script>
    <?php
    include ("database.php");
    if(isset($_POST["userNumber0"])) { //USE HIDDEN FORM
    	$array = array();

    	for ($i=0; $i<10; $i++) {
    		$array[] = $_POST["userNumber$i"];
    	}
    	echo $_POST["userNumber1"];
    	
        
        $results = $db->prepare("INSERT INTO Fighters(fighterFullname, username, Round) VALUES(?, ?, ?)");
        $results->execute(array("rick", "user", 5));
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


