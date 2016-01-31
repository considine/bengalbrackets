<?php

	include ("database.php");


	try {
		for ($x=0; $x<12; $x++) {
			$results = $db->prepare("ALTER TABLE `submissions` ADD `winner" .(3+$x). "` VARCHAR(30) NOT NULL AFTER `winner" .(2+$x)."`");
			$results->execute();
		}
	}
	catch (exception $e) {
		echo $e->getMessage();
	}
?>