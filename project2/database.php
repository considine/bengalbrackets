<?php


//connect to the dattabase
try {
	$db = new PDO("mysql:host=localhost; dbname=shirts4mike; port=3306", "root", "root");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'");

}catch (Exception $e) {
	echo "Could not connect to the database.";
	exit;
}

//query the database
try {
	$results = $db->query("SELECT name, price, img FROM products ORDER BY price ASC");
	

}catch (Exception $e) {
	echo "Could not query database";
	die();
}
echo "<pre>";
var_dump($results->fetchAll(PDO::FETCH_ASSOC));
echo "</pre>"

?>