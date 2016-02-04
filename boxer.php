
  		<?php 
  			include ("database.php"); 
  			if (isset($_POST['name'])) {
         
  				try {

  					$results = $db->prepare("INSERT INTO fighter_info(name, nickname, song, bio, quote, netid, hometown) VALUES(?, ?, ?, ?, ?, ?, ?)");
  					$results->execute(array($_POST['name'], $_POST['nickname'], $_POST['song'], $_POST['bio'], $_POST['quote'],$_POST['netID'], $_POST['hometown']));
				  }
				catch (exception $e) {
					echo $e->getMessage();
				}
				//echo '<script type="text/javascript"> alert ("thank you for your submission"); </script>';
				header( 'Location: http://bengalbrackets.com' ) ; 
				
  			}
  		?>
<!doctype html>
<html>
  <head> 
  	<title>Boxer Info </title>
  	<link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  	<main>
      
  		<?php if(!isset($_POST['name'])) : ?>

  		<div id="boxer_info">
  		<h1> BOXER INFO </h1>
  		<h2> Guys, please only answer for yourself. I'm serious, it will be a huge pain for me to fix </h2>
  		<form action="<?php Echo($_SERVER['PHP_SELF']); ?>" method="post" id="info">
  			<label for="name"> Name </label>
  			<br />
  			<input class="boxer_input" type="text" name="name" id="name">
  			<br />
  			<br />
        <label for="hometown"> Hometown </label>
        <br />
        <input class="boxer_input" type="text" name="hometown" id="hometown">
        <br />
        <br />
  			<label for="quote"> favorite quote: (dont use quotation marks for convention)</label>
  			<br />
  			<input class="boxer_input" type="text" name="quote" id="quote">
  			<br />
  			<br />
  			<label for="nickname"> Nickname </label>
  			<br />
  			<input class="boxer_input" type="text" name="nickname" id="nickname">
  			<br />
  			<br />
  			<label for="song"> Ideal Walk-up Song (Purely hypothetical) </label>
  			<br />
  			<input class="boxer_input" type="text" name="song" id="song">
  			<br /><br />
  			<label for="netID"> netID: </label>
  			<br />
  			<input class="boxer_input" type="text" name="netID" id="netID">
  			<br />
  			<br />
  			<label for="bio"> Short Bio or fun-fact (under 250 characters) </label>
  			<br />
  			<textarea id="bio" name="bio" cols="60" rows="10"> </textarea>
  			<br />
  			<button> Submit </button>
  		</form>

  		</div>
 		<?php else : ?>
 		<h1> THANKS FOR YOUR EMISSION </h1>
 		<p> <a href="http://bengalbrackets.com">  Back to main site </a> </p>
 		<?php endif; ?>
  	</main>
  	<script type="text/javascript" src="jquery.txt"> </script>
	  <script type="text/javascript">
		$('button').click (function () {
   			if (!$('#name').val() || !$('#netID').val()) {
   				alert ("Name and NetID required");
          return false;
   			}
   			else {
         
   				$("#info").submit();
   			
   			}
       

		});

	</script>
  </body>
 </html>