<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style>
		#wrapper{ width:960px; margin:auto;}
		header{margin-top: 50px;}
		.navigation{text-align:center; background-color:#8EBDE4; line-height: 36px; }
		.longnavigation{ background-color:#8EBDE4; line-height: 36px; }
		.filler{background-color:#8EBDE4; line-height: 36px;}
		nav a{ color:white; padding-top:10px; padding-bottom:10px; margin-right:1px;}
		nav .navigation:hover{background-color:#C1C7CB;  }
		nav .longnavigation a{color:white; padding-left:15px; margin-left: -15px; padding-right:15px; padding-top:10px; padding-bottom:10px;}
		nav .longnavigation a:hover{text-decoration:none; color:white; background-color:#C1C7CB;  }
		nav a:hover{text-decoration:none; color:white; background-color:#C1C7CB;  }
		footer{margin-top:60px;}
	</style>
	<title>HÜ_Ue6.2</title>
  </head>
  <body>
	<div id="wrapper">
		<header>
			<img src="img/BlueIT_logo.png" alt="Logo" height="80">
		</header>
		<nav>
		<div class="container-fluid">
			<div class="row">
				<div class="navigation col-xs-1 col-sm-1 col-md-1"><a href="HÜ_Ue6.html">Home</a></div>
				<div class="navigation col-xs-1 col-sm-1 col-md-1"><a href="HÜ_Ue6.html">About</a></div>
				<div class="navigation col-xs-1 col-sm-1 col-md-1"><a href="HÜ_Ue6.html">Portfolia</a></div>
				<div class="navigation col-xs-1 col-sm-1 col-md-1"><a href="#">Kontakt</a></div>
				<div class="longnavigation col-xs-2 col-sm-2 col-md-2"><a href="HÜ_Ue6.html">Mein Konto</a></div>
				<div class="filler col-xs-6 col-sm-6 col-md-6"><a href="#"></a></div>
			</div>
		</div>
		</nav>
		<main>
			<h2>Kontakt</h2>
			<?php
			
				if(isset($_POST['submitBtn'])){
					echo 'Herzlichen Dank für Ihre Anfrage! Aufgrund des derzeitigen Anfragevolumens kann die Beantwortung Ihrer Anfrage längere Zeit in Anspruch nehmen. Wir bitten um Ihr Verständnis und melden uns sobald als möglich bei Ihnen.<br><br>Ihr blueIT-Team';	
				}else{
					echo '<h4>Wir freuen uns auf Ihre Anfrage!</h4>
			<form method="POST" action="#">
				Der Grund für Ihre Anfrage:<br>
				<input type="radio" name="Grund" value="FS">Freie Stelle<br>
				<input type="radio" name="Grund" value="Produktrek">Produktreklamation<br>
				<input type="radio" name="Grund" value="Produktneu">Produktneuheiten<br><br>
				Anrede*:
				<input type="radio" name="Anrede" value="male" required>Herr
				<input type="radio" name="Anrede" value="female">Frau<br><br>
				Vorname*: <input type="text"  name="vn" required>
				Nachname*: <input type="text" name="nn" required><br><br>
				Anfrage*:<br>
				<textarea name="Anfrage" rows="3" cols="30" required></textarea><br>
				<input type="submit" name="submitBtn" value="Anfrage senden">
				</form>';}
				?>
			
		</main>
		<footer>
		</footer>
	</div>
  </body>
  </html>