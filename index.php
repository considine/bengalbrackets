<?php
	require_once 'mobiledetect/Mobile_Detect.php';
	$detect = new Mobile_Detect;
		if ($detect->isMobile() ) {
			//header("Location: http://m.bengalbrackets.com");
			
		}

		if (isset ($_POST['bout0'])) {
			session_start();
			echo $_SESSION['email'];
		}


			$weight_classes = array (
			"137",
			"144",
			"152",
			"157",
			"163",
			"175",
			"182",
			"191",
			"207",
			"Light-Heavy",
			

			);
		session_start();
		if (isset($_SESSION['email'])) {
			$email = $_SESSION['email'];
		}
		else {
			echo '<META http-equiv="refresh" content="0;url=http://bengalbrackets.com">';//"</h1>';
		}
		
		$url = 'http://bengalbrackets.com/brackets/index.php?weight=';
		//$url = 'http://localhost:8888/bengalbrackets/index.php?weight=';
		
		$total_fights = 15;
		if (!isset ($_GET['weight'])) {
			//echo '<META http-equiv="refresh" content="0;url='.$url.$weight_classes[0].'">';//"</h1>';
		}
		$weight = $_GET['weight'];

		include ("submission.php");
		//check to see if this user has made a submission
		
		if (!isset ($_GET['weight'])) {
			echo '<META http-equiv="refresh" content="0;url='.$url.$weight_classes[0].'">';//"</h1>';
		}
		$weight = $_GET['weight'];
		if (!in_array($weight, $weight_classes)) {
			header("Location: http://bengalbrackets.com");
		}
		
		//check ot see if this user has made a submisison

		$results = $db->query("SELECT netid, class FROM boxer_submissions WHERE netid = ".$email.", class = ".$weight);




?>
<!doctype html>

<html>
<head>
<title> Bengalbrackets </title>
<link rel="stylesheet" type="text/css" href="css1/style.css">
</head>

<body id="index">
	
	<?php 
		if (strcmp($weight, "Heavyweight")) {
			echo '<h3 id="weight_header">  '.$weight.'-lb Weight Class Bracket </h3>'; 
		}
		else {
			echo '<h3 id="weight_header">  '.$weight.'  Bracket </h3>'; 
		
		}

	?>

	<div id="main-nav">
		
		<ul>
			<li> <a href="http://bengalbrackets.com"> Home </a> </li>
			<?php 
			$number_classes = count($weight_classes);
			$number_classes --;
			
			for ($x=0; $x<count($weight_classes); $x++) {

				echo '<li> <a href="'.$url.$weight_classes[$x].'"';
				if (strcmp($weight, $weight_classes[$x]) === 0) 
					echo ' id="selected_weight" ';
				echo '> '.$weight_classes[$x];
				if ($x !== $number_classes && $x !== $number_classes-1) {
					echo '-lbs  </a> </li>';
				}
				else {
					echo '  </a> </li>';
				}
				
			}
			?>
		</ul>
	</div>
	<div id="whole_wrap">
	<?php


	$first_round = 8;
	$first_round_perm = $first_round;
	$top = 100; 
	$starting_top = 0;
	$top_increment = 80;
	$round = 1;
	$fight_number = 0;
	
	
	$results = $db->query("SELECT name, netid, weight_class, bye, seed FROM fighter_info WHERE weight_class =  '".$weight."' ORDER BY seed ASC");
	// while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
	// 	echo $row['Name'];
	// }
	
	//FIRST ROUND:
	echo '<div class="inline_block">';
	for ($x=0; $x<$total_fights; $x++) {
		if ($row = $results->fetch(PDO::FETCH_ASSOC)) {
			$name = $row['name'];

		} else $name ="";
		if ($round !== 1) {
			$name="";
		}
		$netid = $row['netid'];

	
		//CREATE ID CODE TO INDICATE NEXT ROUND!!!!!!!!!!!
		$y = ($x)%($first_round) + 1; //total fights plus 1 because that is the number of githers
											// divided by 2 because we iterate twice every time through the loop
					// and the incrementation to go from 0 index to 1 index
		
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

			<div class="own_block '.$round.'" style="height: '.(20 + ($round-1)*10).'px" id="'.$netid.'">
			
			<input type="radio" value="'.$name.'" name="radioChoice'.$x.'" id="firstOpt'.$x.'" class="'.$digit1.' '.'c'.$round.$fight_number.'">
			<label id="'.'l'.$round.$fight_number.'" for="firstOpt'.$x.'" style="height: '.(20 + ($round-1)*10).'px"> '.$name.'</label>
			</div>';
		if ($row = $results->fetch(PDO::FETCH_ASSOC)) {
			$name = $row['name'];
		} else $name ="";
		if ($round !== 1) {
			$name="";
		}
		$fight_number++;
		$netid = $row['netid'];
		
			echo '
			<div class="own_block '.$round.'" style="height: '.(20 + ($round-1)*10).'px"  id="'.$netid.'">
			
			<input type="radio" value="'.$name.'" name = "radioChoice'.$x.'" id="secondOpt'.$x.'" class="'.$digit1.' '.'c'.$round.$fight_number.'">
			<label id= "'.'l'.$round.$fight_number.'"for="secondOpt'.$x.'" style="height: '.(20 + ($round-1)*10).'px"> '.$name.' </label>
			
			</div>
		</form>';

		$top += $top_increment;
		if ($round === 1) {
			if (($x%2) === 0 ) {
				$top -= 25;
			}
			else {
				$top +=25;
			}
		}
		if (($x+1)%$first_round == 0) {
		        	//iterate round
			$fight_number = 0;
        	$round ++;
        	$top_increment*=2;
        	$starting_top += pow(2,($round-2)) * 30;
        	

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
	<form action="<?php Echo($_SERVER['PHP_SELF']); ?>" method="post" id="sub"> 
		<?php
		echo '<input type="hidden" name="weight_class_number" value="'.$weight.'">';
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

	$(document).ready(checkForByes);
	$("#total_submit").click(function () {
		for (i = 0; i < <?php echo $total_fights ?>; i++) { 
   

			var adult = ($('input[name=radioChoice' +  i +']:checked').val());
			if (!adult) {
				alert("You have not submitted all fights \n Please submit fight " + (i+1));
				return;
			}
			document.getElementById("fight"+i).value = adult;
			
			
		}
		$('#sub').submit();
		
		
		
	});


	$(".own_block.1").mouseover (function() {
		document.getElementById('boxer_info').src = "http://bengalbrackets.com/brackets/eachboxer.php?boxer="+$(this).attr("id");
		if (!$(this).attr("id")) {
			return false;
		}
		$("#boxer_info").css("visibility", "visible");
		

		//autoResize('boxer_info');
	});
	function autoResize(id){
	    var newheight;
	    var newwidth;

	    if(document.getElementById){
	        newheight = document.getElementById(id).contentWindow.document .body.scrollHeight;
	        newwidth = document.getElementById(id).contentWindow.document .body.scrollWidth;
	    }

	    document.getElementById(id).height = (newheight) + "px";
	    document.getElementById(id).width = (newwidth) + "px";
	}
	$(".own_block.1").mouseout (function() {
		$("#boxer_info").css("visibility", "hidden");
	});
	
	$("label").click(clicked);


	function clicked () {

		if ($(this).attr("class") === "readonly") {

			return false;
		}

		//for every fight, make sure the innerhtml of the label 
		// is the same as the php




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
	 		//if ($('input[name=radioChoice' + number_fights+']').is(':checked')) {
	 		//if ($('input[type=radio]:checked').size()  === number_fights)
	 		//	alert ('radioChoice' + number_fights );

	 		//}
	 		
			label.innerHTML = label_name.innerHTML;
		}
		function getRoundsLeft(r) {
			var total_fights = <?php echo $total_fights ?> + 1;
		 	var total_rounds = Math.log(total_fights) / Math.log(2);
		 
		 	return (total_rounds-r+1);
		}
		var number_fights = <?php echo $total_fights; ?>-1;
		if ($('input[type=radio]:checked').size() === number_fights) {
			$('#total_submit').css("visibility", "visible");
		}
		else {
			$('#total_submit').css("visibility", "hidden");
		}
		
	
	}
	function resizeIframe(obj) {
		obj.style.height = "50px";
   	 obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  	}
	
	function checkForByes () {
		//iterate through all inputs, if we find a BYE, set other value to true
		for (i=0; i< <?php echo $total_fights; ?>; i++) {
			
			//var label1 = $("label[for='"+'#firstOpt' + i"']");
			var label2 = $('label[for=secondOpt'+i+']');
			var label1 = $('label[for=firstOpt'+i+']');

			//alert (label1.html());
			
			if ($('#firstOpt' + i).attr("value")==="BYE" || $('#firstOpt' + i).attr("value") === " BYE ") {
				$('#secondOpt' + i).attr("checked", true);
				$('#firstOpt' + i).addClass("readonly");
				$('#secondOpt' + i).addClass("readonly");
				clicked.call(label2);
				label1.addClass("readonly");
				label2.addClass("readonly");
				
			}
			if ($('#secondOpt' + i).attr("value")==="BYE" || $('#secondOpt' + i).attr("value")===" BYE ") {

				$('#firstOpt' + i).attr("checked", true);
				$('#firstOpt' + i).addClass("readonly");
				$('#secondOpt' + i).addClass("readonly");
				clicked.call(label1);
				label1.addClass("readonly");
				label2.addClass("readonly");
			

			}
		}
	}
	
	
	</script>
	

	
	<iframe id="boxer_info" width="518" src="http://bengalbrackets.com/brackets/eachboxer.php?boxer=Mschaef4" onload="resizeIframe(this);"> </iframe>
	

</div>
</body>


</html>