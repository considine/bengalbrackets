
<!doctype html>

<html>
<head>
<title> Jack </title>
<link rel="stylesheet" type="text/css" href="css/style.css">


</head>

<body><!doctype html>

<html>
<head>
<title> Jack </title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div id="whole_wrap">
	<form method="post" action="<?php Echo($_SERVER['PHP_SELF']); ?>" >
		<input type="text" name="newBoxer">
		<input type="submit">
	</form>

	<?php 
		include ("database.php");
		if (isset($_POST['bout1'])) {
			echo "<h1> HI </h1>";
		}
		if (isset($_POST['newBoxer'])) {

		
			try {
				$results = $db->prepare("INSERT INTO Fighters(Weight, Sequence, Name) VALUES(?, ?, ?)");
				$results->execute(array(194, 1, $_POST['newBoxer']));
			}
			catch (exception $e) {
				echo $e->getMessage();
			}
		}



	$first_round = 8;
	$total_fights = 15;
	$top = 100; 
	$starting_top = 0;
	$top_increment = 80;
	$round = 1;
	$fight_number = 0;
	

	$results = $db->query("SELECT Name FROM Fighters WHERE Weight = 194");
	// while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
	// 	echo $row['Name'];
	// }
	//FIRST ROUND:
	echo '<div class="inline_block">';
	for ($x=0; $x<$total_fights; $x++) {
		if ($row = $results->fetch(PDO::FETCH_ASSOC)) {
			$name = $row['Name'];
		} else $name ="";
		//CREATE ID CODE TO INDICATE NEXT ROUND!!!!!!!!!!!
		$y = ($x)%($first_round) + 1; //total fights plus 1 because that is the number of githers
											// divided by 2 because we iterate twice every time through the loop
											// and the incrementation to go from 0 index to 1 index
		echo $y; 
		$digit1 = ceil($y);
		$digit2 = ceil($y/2);
		$digit3 = ceil($y/4);
		$digit3 .= $digit2;
		$digit3 .= $digit1;
		$digit1 = $digit3;

		for ($y=1; $y<$round; $y++) {
			$digit1 = substr($digit1, 1);
		}
		$digit1 .= "r";
		$digit1 = strrev($digit1);
		$fight_number++;


		echo '<form action=""  id="radio'.$x.'" class="radio-forms" style="top: '.$top.'px">
			<div class="own_block" style="height: '.(20 + ($round-1)*10).'px">
			
			<input type="radio" value="'.$name.'" name="radioChoice'.$x.'" id="firstOpt'.$x.'" class="'.$digit1.' '.'c'.$round.$fight_number.'">
			<label id="'.'l'.$round.$fight_number.'" for="firstOpt'.$x.'" style="height: '.(20 + ($round-1)*10).'px"> '.$name.' </label>
			</div>';
		if ($row = $results->fetch(PDO::FETCH_ASSOC)) {
			$name = $row['Name'];
		} else $name ="";
		$fight_number++;

			echo '
			<div class="own_block" style="height: '.(20 + ($round-1)*10).'px">
			<input type="radio" value="'.$name.'" name = "radioChoice'.$x.'" id="secondOpt'.$x.'" class="'.$digit1.' '.'c'.$round.$fight_number.'">
			<label id= "'.'l'.$round.$fight_number.'"for="secondOpt'.$x.'" style="height: '.(20 + ($round-1)*10).'px"> '.$name.' </label>
			
			</div>
		</form>';

		$top += $top_increment;
		if ($round === 1) {
			if (($x%2) === 0 ) {
				$top -= 20;
			}
			else {
				$top +=20;
			}
		}
		if (($x+1)%$first_round == 0) {
		        	//iterate round
			$fight_number = 0;
        	$round ++;
        	$top_increment*=2;
        	$starting_top += pow(2,($round-2)) * 40;
        	

        	$top = 100 + $starting_top;
        	$top -= 10;
        	$iterator = 0;
        	$first_round = $first_round / 2;
			echo '</div>';
			echo '<div class="inline_block">';
    	}
    
	}
	echo '</div>';
	echo '</div>';
	//SECOND ROUND
	
	?>
	<form action="test.php" method="post" id="sub"> 
		<?php
		for ($j=0; $j<$total_fights; $j++) {
			echo '
			<input type="hidden" name="bout'.$j.'" id="fight'.$j.'">
			';
		}
		?>
	</form>
	<button id="total_submit"> Submit Bracket </button>
	<script type="text/javascript" src="jquery.txt"> </script>
	<script type="text/javascript">
	$("#total_submit").click(function () {
		for (i = 0; i < <?php echo $total_fights ?>; i++) { 
   

			var adult = ($('input[name=radioChoice' +  i +']:checked').val());
			if (!adult) {
				alert("You have not submitted all fights \n Please submit fight " + (i+1));
				return;
			}
			document.getElementById("fight"+i).value = adult;
			
			
		}
		$("#sub").submit();
		
	});

	$("label").click(function (event) {
		var label_name = document.getElementById($(this).attr("id"));

		var y = document.getElementById($(this).attr("for"));
		if (y.value === "") {

			return false;
		}
		//get the name of the radio buttons of which the selection was made
		var radio_name = y.name;
		//get the value that was selected before
		var previous_value = ($('input[name='+radio_name+']:checked').val());

		var z = y.className.split(/\s+/);
		

		var r = z[1].substring(1, 2); //get the round of this label
		var r2 = z[0].substring(1, 2); //get the next round;

		r++; //iterate round
		if (r !== 5) {
	 		var label = document.getElementById("l" + r + r2);
	 		//alert("c" + r + r2);
	 		var nextInput = document.getElementsByClassName("c" + r + r2);


	 		if (nextInput[0].value) {
	 			
	 			var nextRoundRadio = nextInput[0].name;
	 			
	 			var next_value = ($('input[name='+nextRoundRadio+']:checked').val());
	 			var check1 = "check1";
	 			var check2 = "check2";
	 			if (next_value) {
	 				check1 = next_value.replace(/\s+/g, '');
	 			}
	 			if (previous_value) {
	 				check2 = previous_value.replace(/\s+/g, '');
	 			}


	 			// need to get the codename for the next input

	 			


	 			//see if the winner of the next fight is now the loser of the next fight. Would casue a problem so we'd need to clear that fight
	 			if (check1 === check2) {

	 				var total_rounds_left = getRoundsLeft(r);
	 				//alert (total_rounds_left);
	 				for (i=0; i<total_rounds_left; i++) {
	 					var next_label = document.getElementById("l" + (i+r) + z[0].substring(i+1, i+2));
	 					//alert ("l" + (i+r) + z[0].substring(i+1, i+2));
	 					//alert (z[0].substring(i+1, i+2));
	 					var future_input =  document.getElementsByClassName("c" + (i+r) + z[0].substring(i+1, i+2));
	 					var future_input_class =  "c" + (i+r) + z[0].substring(i+1, i+2);
	 					if (next_label) {
	 						//alert (future_input[0].value);
	 						future_input[0].value = "";
	 						future_input[0].checked = false;
	 						next_label.innerHTML = "";
	 					}
	 				}
	 			}

	 		}


	 		nextInput[0].value = label_name.innerHTML;
			label.innerHTML = label_name.innerHTML;
		}
		function getRoundsLeft(r) {
			var total_fights = <?php echo $total_fights ?> + 1;
		 	var total_rounds = Math.log(total_fights) / Math.log(2);
		 
		 	return (total_rounds-r+1);
		}
		
	
	});
	</script>
	<?php 
	for ($j=0; $j<$total_fights; $j++) {
		if (isset($_POST['bout'.$j])) {
	    	echo $_POST['bout'.$j];
	    }
	   
	}

   // echo "HELLO ";

	?>
</div>
</body>


</html></body>


</html>