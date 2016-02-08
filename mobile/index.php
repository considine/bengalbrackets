<?php
	require_once 'Mobile_Detect.php';
	$detect = new Mobile_Detect;
		if (!$detect->isMobile() ) {
			//header("Location: http://bengalbrackets.com");
		}
		include ("database.php"); // todo get path

		//first order of business is to get all of the boxers!
		$query = "SELECT name, nickname, bio, netid, hometown, quote  FROM fighter_info WHERE netid = '" .$boxer."'";
		$results = $db->query($query);
		$row = $results->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html> 
<html>
	<head> 
		<meta name="viewport" content="width=device-width, initial-scale=3">
		<title> BengalBrackets </title> 
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<main>
			<h1 class="mobile_title"> Bengalbrackets Mobile </h1>
			<div id="mobile_form">
			<form> 
				
				<input type="radio" name="matchup" id="top">
				<label for="top"> Top Boxer </label> 
				<br /> 
				<input type="radio" name="matchup" id="bottom">
				<label for="bottom"> Bottom Boxer </label>
				<br />
				<button type="submit"> Next </button>
			</form>
			</div>
		 </main>
	</body>
</html>