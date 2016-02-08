<!doctype html>
<html>
	<head>
		<title> Boxer Info </title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body id="each_boxer">
	
<?php 
	include ("database.php"); 

	$boxer = $_GET['boxer'];
	$query = "SELECT name, nickname, bio, netid, hometown, quote  FROM fighter_info WHERE netid = '" .$boxer."'";
	$results = $db->query($query);

	
	
	$row = $results->fetch(PDO::FETCH_ASSOC);
		$name = $row['name'];
		$netid = $row['netid'];
		$nickname = $row['nickname'];
		$quote = $row['quote'];
		$bio = $row['bio'];
		$hometown = $row['hometown'];
		echo '<div class="table_wrap">';
		echo '<div class="inner_table_wrap">';
		echo '<table style="width:100%" class="boxer_table">';
			echo '<tr> <td> <strong>  NAME: </strong>'.$name.'</td>';
			if ($nickname !== "")echo '<tr> <td> <strong>  NICKNAME: </strong>'.$nickname.'</td>';
			if ($hometown !== "")echo '<tr> <td> <strong>  HOMETOWN: </strong>'.$hometown.'</td>';
			echo '<hr />';
			if ($bio !== "")echo '<tr> <td> <strong>  BIO: </strong>'.$bio.'</td>';		
			if ($quote !== "")echo '<tr> <td> <i>"'.$quote.'" </i> </td>';	
			
		echo '</table>';
		echo '</div>';
		echo '<img src="https://i0.wp.com/static.teamtreehouse.com/assets/content/default_avatar-1194852ae95df3501aed27c0a96da653.png?ssl=1" width="120" id="userpic">';
		echo '</div>';

		
	?>

</body>
</html>