<?php 
	include ("database.php"); 
	$results = $db->query("SELECT name, nickname, bio, netid, hometown FROM fighter_info ORDER BY netid");
 ?>



 	<table style="width:100%" border="1">
 		<tr>
 			<td> <strong> Name </strong> </td>
 			<td> <strong> netid </strong> </td>
 			<td> <strong> hometown </strong> </td>
 			<td> <strong> nickname </strong> </td>
 			<td> <strong> bio </strong> </td>

 		<?php
  			while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
				$name = $row['name'];
				$netid = $row['netid'];
				$nickname = $row['nickname'];
				$bio = $row['bio'];
				$hometown = $row['hometown'];


				echo '<tr>';
				echo '<td class="open_window"> ' . $name . ' </td>';
				echo '<td> ' . $netid . ' </td>';
				echo '<td> ' . $hometown . ' </td>';
				echo '<td> ' . $nickname . ' </td>';
				echo '<td> ' . $bio . ' </td>';
				echo '</tr>';
			} 
		?>

	</table>
	<script type="text/javascript" src="jquery.txt"> </script>
	<script type="text/javascript">
	$('.open_window').click(function () {
		if (myWindow) {
			myWindow.close();
		}
		var myWindow = window.open("", "", "width=200, height=100");
	});



	</script>
  			
