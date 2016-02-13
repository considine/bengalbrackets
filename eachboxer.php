<!doctype html>
<html>
	<head>
		<title> Boxer Info </title>
		<link rel="stylesheet" type="text/css" href="css1/style.css">
	</head>
	<body id="each_boxer">
	
<?php 
	include ("database.php"); 

	$boxer = $_GET['boxer'];
	$query = "SELECT name, nickname, bio, netid, hometown, quote, url  FROM fighter_info WHERE netid = '" .$boxer."'";
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
		if ($row['url']) {
			echo '<img src="'.$row['url'].'" width="120" id="userpic">';
		}
		else {
			echo '<img src="https://sakailogin.nd.edu/profile2-tool/images/no_image.gif" width="120" id="userpic">';
		}
		
		echo '</div>';

		
	?>

</body>
</html>