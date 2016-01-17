<?php

include ("database.php");
//check if username exists already!
$jack = $_POST['username'];
$results = $db->query("SELECT username, password FROM friends WHERE username = '" .mysql_real_escape_string($jack). "'");
$entries = $results->fetchAll(PDO::FETCH_ASSOC);
//count number of existing
$i = 0;foreach ($entries as $entry) {	$i++;}

if ($i > 0) {
	session_start();
	
	unset ($_SESSION['invalidUser']);
	$_SESSION['invalidUser'] = "Username taken!";
	header ("Location: index.php");
	die();
}
else {
	echo "not taken";
}





try {
        $results = $db->prepare("INSERT INTO friends(username, password) VALUES(?, ?)");
        //encrypt password
        $password = $_POST['password'];
        str_replace('"',"'",$password);
        $username = $_POST['username'];
        $Newpassword = password_hash($password, PASSWORD_BCRYPT);
        str_replace('"',"'",$Newpassword);
        //todo potentially delete this 
        if (password_verify($password, $Newpassword)) {
	        $results->execute(array($username, $Newpassword));
	        echo "good";
	    }

}catch (Exception $e) {
        echo "Could not insert into the database" . $e->getMessage();
        die();
}
echo "inserted";


$_COOKIE['firstName'] = "YOyoma";
?>
