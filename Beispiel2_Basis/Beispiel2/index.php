<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>index</title>
		<style>
		</style>
	</head>
	<body>
		
		<h1>Grid Generator</h1>
		<form action="#" method="POST">
		<lable><input type="checkbox" name="days[]" value="Su">Sunday</lable><br>
		<lable><input type="checkbox" name="days[]" value="Mo">Monday</lable><br>
		<lable><input type="checkbox" name="days[]" value="Tu">Tuesday</lable><br>
		<lable><input type="checkbox" name="days[]" value="We">Wednesday</lable><br>
		<lable><input type="checkbox" name="days[]" value="Thu">Thursday</lable><br>
		<lable><input type="checkbox" name="days[]" value="Fr">Friday</lable><br>
		<lable><input type="checkbox" name="days[]" value="Sa">Saturday</lable><br>
		Enter number of fields <input type="text" name="num"><br>
		<input type="submit" name="BtnSubm" value="Generate..."><br>
		</form>
		<hr></hr>
		<?php
		
		if(!isset($_POST['BtnSubm'])){
			exit();
		}
		$day=$_POST['days'];
		echo "<div class=\"table-responsive\">
  		<table class=\"table\">
		<thead>
		<tr>
			<th>Days</th>";
				for($i=1; $i<=$_POST['num'];$i++)
				{
					echo "<th>Events {$i}</th>";
				}
		echo "</tr>
		</thead>
		<tbody>";
		
			for($j=0; $j < (sizeof($day)); $j++)
			{
				echo "<tr>";
				echo"<td>";
				echo $day[$j];
				echo "</td>";
				for($o=0; $o < $_POST['num'];$o++)
				{
				echo "<td>event {$j}.{$o}</td>";
				}
				echo "</tr>";
			}
			echo "</tbody>
			</table>
			</div>"; 
		
		?>
	</body>
</html>