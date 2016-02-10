<form action="index.php" method="post">
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

	<?php 
		if (isset($_POST['email'])) {
			
		}
	?>
</form>