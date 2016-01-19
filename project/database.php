<?php


ini_set('display_errors', 'On');
try {
  
  $db = new PDO('sqlite:./databsase.db');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e) {
  echo $e->getMessage();
  die();
}

?>
