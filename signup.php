<?php
	
	if (isset($_POST['email']) && isset ($_POST['ticket_number'])) {
		if (strlen ( $_POST['email'] ) === 0 || (strpos($_POST['email'], '@') === FALSE)) {
			echo "Please enter a valid email";
		}
		if (strlen ($_POST['ticket_number'])!==5 || !is_numeric($_POST['ticket_number'])) {
			echo 'That is not a valid ticket!';
		}
		else {
			session_start();
			$_SESSION['email'] = $_POST['email'];
			//store the name
			echo '<script type="text/javascript">'
   , 'window.top.location.href = "http://www.bengalbrackets.com/brackets";'
   , '</script>';
;
		}
		
	}
	if (isset($_POST['netid'])) {
		//check to see if its in database
		include ("database.php");
		$net = $_POST['netid'];
		$results = $db->query("SELECT netid, name FROM fighter_info WHERE netid =  '".$net."'");
		if ($row = $results->fetch(PDO::FETCH_ASSOC)) {
			echo $row['name'];
		}
		else {
			echo "netid doesnt exist";
		}
	}
	
?>

<form action="<?php Echo($_SERVER['PHP_SELF']); ?>" method="post">
	<label for="email" style="font-family: helvetica; color: #555;">Email:</label>
	<br />
	<input type="text" name="email" id="email">
	<br />
	<br />
	<label for="ticket_number" style="font-family: helvetica; color: #555;">Ticket Number:</label>
	<br />
	<input type="text" name="ticket_number" id="ticket_number">
	<br />
	<button type="submit"> Fill out your brackets! </button>

	
</form>
<br />
<br />

<p> Boxer Pool (Only Applicable for participants) <p>
<form action="<?php Echo($_SERVER['PHP_SELF']); ?>" method="post">
	<label for="netid" style="font-family: helvetica; color: #555;">netid:</label>
	<br />
	<input type="text" name="netid" id="netid">
	<br />
	
	<button type="submit"> Fill out your brackets! </button>

	
</form>