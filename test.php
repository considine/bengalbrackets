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
	<form method="post" action="<?php Echo($_SERVER['PHP_SELF']); ?>" >
		<input type="text" name="newBoxer">
		<input type="submit">
	</form>

	<?php 
		include ("database.php");
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
		//need to make the id code
		$digit1 = ceil($x/2);
		$digit2 = ceil($x/4);
		$digit3 = ceil($x/8);
		$digit1 .= $digit2;
		$digit1 .= $digit3;




		echo '<form action=""  id="radio'.$x.'" class="radio-forms" style="top: '.$top.'px">
			<div class="own_block">
			
			<input type="radio" value="'.$name.'" name="radioChoice'.$x.'" id="firstOpt'.$x.'" class="'.$digit1.'">
			<label id="'.$x.'" for="firstOpt'.$x.'"> '.$name.' </label>
			</div>';
		if ($row = $results->fetch(PDO::FETCH_ASSOC)) {
			$name = $row['Name'];
		} else $name ="";

			echo '
			<div class="own_block">
			<input type="radio" value="'.$name.'" name = "radioChoice'.$x.'" id="secondOpt'.$x.'" '.$digit1.'>
			<label for="secondOpt'.$x.'"> '.$name.' </label>
			
			</div>
		</form>';

		$top += 75;
		if (($x%2) === 0) {
			$top -= 20;
		}
		else {
			$top +=20;
		}
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
	<button id="total_submit"> Jackson </button>
	<script type="text/javascript" src="jquery.txt"> </script>
	<script type="text/javascript">
	$("#total_submit").click(function () {
		for (i = 0; i < <?php echo $total_fights ?>; i++) { 
   

			var adult = ($('input[name=radioChoice' +  i +']:checked').val());
			document.getElementById("fight"+i).value = adult;
		
			
		}
		$("#sub").submit();
		
	});

	$("label").click(function (event) {
		for (i =0; i< 8; i++) {
		
			document.getElementById($(this).attr("for")).value = 'Hello';
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
</body>


</html></body>


</html>