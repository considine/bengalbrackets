<?php
	include ("database.php");
	$submissions = array();
	$cols = array();
	$cont = 24;
	$cols[] = "netID";
	$cols[] = "weight";
	$submitted = True;
	$submissions[] = "netID";
	$submissions[] = $weight_sub;
	

	for ($j=0; $j<$total_fights; $j++) {
		if (isset($_POST['bout'.$j])) {
	    	$submissions[] = $_POST['bout'.$j];
	    	$cols[] = 'winner' . ($j+1);
	    }
	    else {
	    	$submitted = False;
	    }

	}
	 //$results = $db->prepare("INSERT INTO friends(username, password) VALUES(?, ?)");
	if ($submitted) {
		
		echo '<script type="text/javascript"> alert("hello") </script>';
	 	
	 	$columns = implode ($cols, ', ');
	 	$sql = "INSERT INTO submissions(".$columns.") VALUES (";
	 	for ($j=0; $j<$total_fights+2; $j++) {
	 		if ($j === ($total_fights+1)) $sql.= "?)";
			else $sql.= "?, ";
	 	}
	 	// die ($sql);
	 	$results = $db->prepare ($sql);
	 	var_dump($sql);
	 	var_dump($submissions);
	 
	 	$results->execute($submissions);
	 	
	 	
		//$results = $db->prepare("INSERT INTO submissions(netID, winner) VALUES(?)");
		// $results->execute(array("jconsidi"));
	}


?>