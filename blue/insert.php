<?php

include ("database.php");
//query the database

echo $_POST ['firstname'];
try {
        $results = $db->prepare("INSERT INTO friends(firstName, lastName) VALUES(?, ?)");
        $results->execute(array($_POST ['firstname'], $_POST['lastname']));

}catch (Exception $e) {
        echo "Could not insert into the database" . $e->getMessage();
        die();
}

session_start();
$_SESSION['firstName'] = $_POST ['firstname'];
$_COOKIE['firstName'] = "YOyoma";
?>
