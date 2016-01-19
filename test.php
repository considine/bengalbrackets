<!doctype html>

<html>
<head>
<title> Jack </title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<?php 
	$first_round = 8;
	for ($x=0; $x<$first_round; $x++) {
		echo '<form action="test.php" method="post" id="radio'.$x.'">
			<div class="own_block">
			
			<input type="radio" value="man" checked name="radioChoice'.$x.'" id="firstOpt'.$x.'">
			<label for="firstOpt'.$x.'"> Man </label>
			</div>
			<div class="own_block">
			<input type="radio" value="woman" name = "radioChoice'.$x.'" id="secondOpt'.$x.'">
			<label for="secondOpt'.$x.'"> Woman </label>
			
			</div>
		</form>';
	}
	
	?>
	<form action="test.php" method="post" id="sub"> 
		<?php
		for ($j=0; $j<$first_round; $j++) {
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
		for (i = 0; i < <?php echo $first_round ?>; i++) { 
   

			var adult = ($('input[name=radioChoice' +  i +']:checked').val());
			document.getElementById("fight"+i).value = adult;
		
			
		}
		$("#sub").submit();
		
	});
	</script>
	<?php 
	for ($j=0; $j<$first_round; $j++) {
		if (isset($_POST['bout'.$j])) {
	    	echo $_POST['bout'.$j];
	    }
	   
	}

   // echo "HELLO ";

	?>
</body>


</html>