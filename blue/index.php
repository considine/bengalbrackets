<?php 
if (empty($_COOKIE['firstName'])) {
session_start();
echo $_SESSION['firstName'];
}
else {
echo $_COOKIE['firstName'];
}?>

<!DOCTYPE HTML>

<h1> Hel </h1>
<form action="insert.php" method="post">
firstnamemm: <input type= "text" name= "firstname" /> lastName: <input type="text" name= "lastname"/>


<button type="submit"> What de fuck</button>
</form>
