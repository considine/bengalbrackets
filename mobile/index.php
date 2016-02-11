<?php
	require_once 'Mobile_Detect.php';
	$detect = new Mobile_Detect;
		if (!$detect->isMobile() ) {
			//header("Location: http://bengalbrackets.com");
		}
		include ("database.php"); // todo get path

		//first order of business is to get all of the boxers!
		$round = 1;
		$fight = 1;
		$total_fights = 15;
		$first_round = 8;
		$weight = $_GET['weight'];
		
		session_start();
		$_SESSION["round"] = 5;
		$weight_classes = array (
			"135",
			"145",
			"149",
			"167",
			"178",
			"184",
			"196",
			"Heavyweight"
			);
		$url = 'http://localhost:8888/bengalbrackets/mobile/index.php?weight=';
		//$url = 'http://m.bengalbrackets.com/index.php?weight=';
		$results = $db->query("SELECT name, netid, weight_class, quote, bio, bye FROM fighter_info WHERE weight_class = '" .$weight."'"); 
		if (!isset ($_GET['weight'])) {
			echo '<META http-equiv="refresh" content="0;url='.$url.$weight_classes[0].'">';//"</h1>';
		}
		if (!in_array($weight, $weight_classes)) {
			header("Location: http://bengalbrackets.com");
		}
		
		

	//	$results = $db->query($query);
		
?>

<!doctype html> 
<html>
	<head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> BengalBrackets </title> 
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<main>
			<h1 class="mobile_title"> Bengalbrackets Mobile </h1>
				<input type="checkbox" id="drawer-toggle" name="drawer-toggle"/>
				<label for="drawer-toggle" id="drawer-toggle-label"></label>
				<header> <?php echo $weight . '-lbs';?></header>
				<br />
				<br />
				<nav id="drawer">
			      <ul>
			         <?php
			         	//each <li> <a>
						for ($x=0; $x<count($weight_classes); $x++) {

							echo '<li> <a href="'.$url.$weight_classes[$x].'"';
							if (strcmp($weight, $weight_classes[$x]) === 0) 
								echo ' id="selected_weight" ';
							echo '> '.$weight_classes[$x];
							if ($x !== $number_classes) {
								echo '-lbs  </a> </li>';
							}
							else {
								echo '  </a> </li>';
							}
							echo '<br />';
							
						}
						?>
			      </ul>
			     </nav>
   				
     			 
   				
		
		 	<div id="page-content">
			<div id="mobile_form">
						 <button id="restart"> Start-Over </button> 
						<br />
				<br />
			<?php echo '<h2 id="fight_head"> Fight: 1/16</h2>';
			for ($x=0; $x<$total_fights; $x++) {
				$row = $results->fetch(PDO::FETCH_ASSOC);
				echo '<div class="form_container" id="form'.$x.'">';
				echo '<section class="top_boxer">';
				echo '<input name="choice'.$x.'" type="radio" id="first'.$x.'">';

				echo '<label class="lform'.$x.'" for="first'.$x.'""> <strong>'.$row['name'].'</strong></label>';
				echo '<br />';
				echo '<label class="lform'.$x.'" for="first'.$x.'"">'.$row['bio'].'</label>';
				echo '<br />';
				echo '<label class="lform'.$x.'" for="first'.$x.'""><i>'.$row['quote'].'</i></label>';
				echo '<br />';
				echo '<br />';
				echo '<br />';
				echo '</section>';
				echo '<section class="bottom-boxer">';
				$row = $results->fetch(PDO::FETCH_ASSOC);
				
				echo '<input name="choice'.$x.'" type="radio" id="second'.$x.'">';
				echo '<label class="lform'.$x.'" for="second'.$x.'"> <strong> '.$row['name'].' </strong> </label>';
				echo '<br />';
				echo '<label class="lform'.$x.'" for="second'.$x.'"">'.$row['bio'].'</label>';
				echo '<br />';
				echo '<label class="lform'.$x.'" for="second'.$x.'""><i>'.$row['quote'].'</i></label>';
				echo '<br />';
				echo '</section>';
				if ($x==5) {
					echo '<br />';
					echo '<button> Submit weightclass! </button>';
				}
				echo '</div>';
			}	
			?>

			</div>
			</div>
			<div>
			
		 
		</div>
			
			<form method="post" id="sub" action="<?php Echo($_SERVER['PHP_SELF']); ?>">
				<?php 
					for ($x=0;$x<$total_fights;$x++) {
						echo '<input type="hidden" id="fight'.$x.'" name="fight'.$x.'">';
					}
				?>
			</form>
			
		 </main>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"> </script>
		<script type="text/javascript">
			$('#restart').click (function () {
				location.reload();
			})
			$('label').click(function () {
				var myClass = getClass($(this)); 
			
				myClass = getForm(myClass);

				
				lastChar = getNextFight(myClass);
				if (lastChar > 14) {
					alert ('stop');
					return false;
				}
				else {
					hideElement(myClass);
					updateFight(lastChar);
					window.setTimeout(showform(lastChar), 20000);
					updateButtonState('last_button', 'b'+lastChar);
				}
			
			});

			// $('#next_button').click (function () {
			// 	alert (round++);


			// //store the value 



			// //set checked for both to false

			// //update input value

			// //update label

			// //update fight header
			
			// //<?php $fight ++; ?>
			
			// });
			$('#last_button').click(function () {
				backTrack( ($('#last_button').attr('class')));
				
			});
			$('section').click (function () {
				var classe = $(this).attr('class');
				alert($(classe > 'label').attr('class'));
			});
			function getForm (myClass) {
				return myClass.substr(1);
			}
			function hideElement(id) {
				//alert ("#" + id);
				$("#" + id).css("visibility", "hidden");
			}
			function showform(formNumber) {
				$("#form" + formNumber).css("visibility", "visible");
			}
			function updateFight (fightNumber) {
				$("#fight_head").html("Fight: " + (fightNumber+1) + '/16');
			}
			function getNextFight (myClass) {
				if (myClass.length > 5) {
					var lastChar = myClass.substr(myClass.length - 2);
				}
				else {
					var lastChar = myClass.substr(myClass.length - 1);
				}
				return ++lastChar;
			}
			function getClass(element) {
				return element.attr("class");
			}
			function getLastFight (myClass) {

				var lastChar = myClass.substr(myClass.length - 1);
				return --lastChar;
			}
			function updateButtonState (buttonId, newClass) {
				$('#' + buttonId).css("visibility", "visible");
				$('#' + buttonId).removeClass($('#' + buttonId).attr('class'));
				$('#' + buttonId).addClass(newClass);
				
			}
			function backTrack (buttonClass) {
				var bId = $('.' + buttonClass).attr('id');
				
				var formNumber = buttonClass.substr(buttonClass.length - 1);
				var oldClass = $("#"+buttonClass).attr("class");
				var newClass = 'b' + (formNumber+1);
				
				updateButtonState(bId, newClass);

				//alert (formNumber);
				hideElement('form' + formNumber);
				formNumber--;
				updateFight(formNumber);
				showform(formNumber);
			}



		</script>
	</body>
</html>