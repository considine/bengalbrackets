<?php
	include ("database.php");
	$submissions = array();
	$cols = array();
	$cont = 24;
	$cols[] = "Email";
	$cols[] = "weight";
	$submitted = True;
	session_start();
	$submissions[] = $_SESSION['email'];
	$weight_sub = $_POST['weight_class_number'];
	$submissions[] = $weight_sub;
	
	if (isset($_POST['weight_class_number'])) {
		$sql1 = "INSERT INTO boxer_submissions(netid, class) VALUES(?, ?)";
		$results1 = $db -> prepare ($sql1);
		$results1->execute(array ($_SESSION['email'],$weight_sub  ));
	}

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
		
		
	 
	 	$columns = implode ($cols, ', ');
	 	$sql = "INSERT INTO submissions(".$columns.") VALUES (";
	 	for ($j=0; $j<$total_fights+2; $j++) {
	 		if ($j === ($total_fights+1)) $sql.= "?)";
			else $sql.= "?, ";
	 	}
	 	// die ($sql);
	 	
	 	
	 	
	 	try {
	 		$results = $db->prepare ($sql);
	 		$results->execute($submissions);
	 	}
	 	catch (exception $e) {
	 		header("Location: http://bengalbrackets.com");
	 	}
	 
	 	
	 	
	 	
		//$results = $db->prepare("INSERT INTO submissions(netID, winner) VALUES(?)");
		// $results->execute(array("jconsidi"));
	}


?>