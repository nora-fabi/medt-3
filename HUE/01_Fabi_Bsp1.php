<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
	<style>
	</style>
  </head>
  <body>
	<h1>Beispiel 1</h1>
	<form action="#">
		Ihre Eingabe: <input type="text" name="Text" placeholder="Demo Text"><br>
		<br><input type="submit" name="explodeBtn" value="Explode">
		<input type="reset" name="resetBtn" value="Reset">
	</form><br>
	<?php 
		$explode=explode(" ",$_GET["Text"]);
		$CSS_STYLE="background-color:#d9d9d9";
		if(isset($_GET["explodeBtn"])){
		echo "Ihre Eingabe als Liste:<br>";
		echo "<ul>";
		for($i=0;$i<sizeof($explode);$i++)
			{
				if($i % 2)
				echo "<li>".$explode[$i]."</li>";
				else
				echo "<li style=\"$CSS_STYLE\">$explode[$i]</li>";
			}
		echo "</ul>";
	}
		else if(isset($_GET["resetBtn"])){
		echo reset($explode);
		}
		
		?>
  </body>
</html>