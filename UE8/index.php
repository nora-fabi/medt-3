<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>index</title>
	</head>
	<body>
		<?php
		$host='localhost';
		$dbname= 'medt-3';
		$user='nora';
		$pwd='htluser';
		
		$db=new PDO ("mysql:host=$host;dbname=$dbname", $user, $pwd);
		
		if($db==true)
		{
			echo 'true';
			
		}
		?>
	</body>
</html>
