<?php

include ("database.php");
//query the database



/*
GET USERNAME AND PASSWORD VARIABLES

*/
$jack = $_POST["username"];

$password = $_POST['password'];
str_replace('"',"'",$password);
$table = "friends";

/* INSERT INTO THE DATABASE
*/
try {
        $results = $db->query("SELECT username, password FROM friends WHERE username = '" .mysql_real_escape_string($jack). "'");
		
       
}catch (Exception $e) {   /* NOTIFY IF DATABASE CONNETION DOES NOT WORL */
        echo "Could not insert into the database" . $e->getMessage();
        die();
}


/* CONFIRM THAT THERE IS ONLY ONE USERNAME IN THIS DATABASE THAT MATCHES THE ENTERED USERNAME
TODO: OPTIMIZE/ REMOVE FOREACH
*/ 
$entries = $results->fetchAll(PDO::FETCH_ASSOC);
$i = 0;

foreach ($entries as $entry) {
	$i++;
	$realpassword = $entry["password"];
	//echo $realpassword;
}
str_replace('"',"'",$realpassword);

/* HANDLE POTENTIAL ERRORS */
try {
	
	if ($i == 0) {

		session_start();

		$_SESSION['invalidUser'] = "Invalid Username";
		header("Location: index.php");
	}
	/* SUCCESSFUL */

	 else if (password_verify($password, $realpassword)) {

	 	
		session_start();
	 	unset ($_SESSION['invalidUser']);
	 	$_SESSION['login'] = $jack;
	 	header ("Location: loggedin.php");
	 }
	 /* UNSUCCESFUL IN VALIDATING PASSWORD */
	 else {
	 	
	 	session_start();
	 	unset ($_SESSION['invalidUser']);
	 	$_SESSION['invalidUser'] = "Invalid password";
		header("Location: index.php");
	 	
	 	
	 }
 }
 catch (Exception $e) {
 	echo "There was an issue ". $e->getMessage();
 }

