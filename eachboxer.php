<!doctype html>
<html>
	<head>
		<title> Boxer Info </title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>

<?php 
	include ("database.php"); 
	$boxer = $_GET['boxer'];
	
	$results = $db->query("SELECT name, nickname, bio, netid, hometown, quote  FROM fighter_info WHERE netid = '" .mysql_real_escape_string($boxer). "'");

	
	
	$row = $results->fetch(PDO::FETCH_ASSOC);
		$name = $row['name'];
		$netid = $row['netid'];
		$nickname = $row['nickname'];
		$quote = $row['quote'];
		$bio = $row['bio'];
		echo $bio;
		$hometown = $row['hometown'];
		echo '<div class="table_wrap">';
		echo '<div class="inner_table_wrap">';
		echo '<table style="width:100%" class="boxer_table">';
			echo '<tr> <td> <strong>  NAME: </strong>'.$name.'</td>';
			if ($nickname !== "")echo '<tr> <td> <strong>  NICKNAME: </strong>'.$nickname.'</td>';
			if ($hometown !== "")echo '<tr> <td> <strong>  HOMETOWN: </strong>'.$hometown.'</td>';
			if ($bio !== "")echo '<tr> <td> <strong>  BIO: </strong>'.$bio.'</td>';		
			if ($quote !== "")echo '<tr> <td> <strong>  QUOTE: </strong>'.$quote.'</td>';	
			if ($netid !== "")echo '<tr> <td> <strong>  NETID: </strong>'.$netid.'</td>';	
		echo '</table>';
		echo '</div>';
		echo '<img src="https://pbs.twimg.com/profile_images/659767469184151552/9amBz1e-_400x400.jpg" width="120" id="userpic">';
		echo '</div>';

		
	?>
	<table style="width:100%">
	  <tr>
	    <td>Jill</td>
	    <td>Smith</td> 
	    <td>50</td>
	  </tr>
	  <tr>
	    <td>Eve</td>
	    <td>Jackson</td> 
	    <td>94</td>
	  </tr>
	</table>
</body>
</html>