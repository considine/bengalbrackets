<?php
$dbname = "Picks";
$dbusername  = "root";
$dbpassword = "root";
//connect to the dattabase
try {
	$db = new PDO("mysql:host=localhost; dbname=$dbname; port=3306", "$dbusername", "$dbpassword");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'");
}catch (Exception $e) {
	echo "Could not connect to the database." . $e->getMessage();
	exit;
}
