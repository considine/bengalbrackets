<?php 
if (empty($_COOKIE['firstName'])) {
session_start();
if (isset($_SESSION['invalidUser'])) {


echo $_SESSION['invalidUser'];
}
}


// if (password_verify ("Shoss", ) {
// 	echo "YOU DA MAN";
// }

else {
echo $_COOKIE['firstName'];
}

?>

<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Jack</title>
</head>
<body>
	<div id="loginWrapper">
		<div id="login">
			<h1> Login </h1>
			<form action="check.php" method="post">
				<label for="username"> Charlie: </label>
				<input type= "text" name= "username" id="username"/>
				<label for="password"> Password: </label>
				<input type="password" name= "password" id="password"/>
				<button type="submit"> Login!</button>
			</form>
		</div>
	</div>
	<h1 id="signup"> Sign up </h1>
	<div class="signupform">
	<form action="insert.php" method="post">
		USERNAME: <input type="text" name="username" />
		PASSWORD: <input type="password" name="password" />
		<button type="submit"> Sign Up</button>
	</form>
	</div>
	<script src="jquery.txt"></script>
	<script>
	$("#signup").click(function() {
		$(".signupform").css("visibility", "visible");
	});




	var main = function () {
		$(".signupform").css("visibility", "hidden");

	}


	$(document).ready(main);


	</script>
</body>
</html>