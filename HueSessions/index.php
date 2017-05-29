<?php
		if(isset($_POST['confirm'])){
			if($_POST['username']=="nora" && $_POST['psw']=="nora")
			{
				session_start();
				$_SESSION['username']= "nora";
				header('Location: http://localhost/medt/Ue8/SessionsHue/project-list.php');
				exit;
			}
		}
	?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>LogIn</title>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
	</head>
	<body>
	<div class="container">
	
	
	<h1>Herzlich willkommen!</h1>
	<?php
		if(isset($_GET['logout']))
		{
			echo "<p>Sie wurden erfolgreich ausgeloggt!</p>";
		}
	?>
	<h4>Anmelden:</h4>
	<form method="POST" action="#">
	<label>Benutzername: <input type="text" name="username"></label><br>
	<label>Passwort: <input type="password" name="psw"></label><br>
	<input type="submit" name="confirm" value="Anmelden">
	</form>
	</div>
	</body>
</html>
