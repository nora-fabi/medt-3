<?php require "isLogedIn.php";
	if(isset($_POST['logOut'])) 
	{
		session_unset();
		session_destroy();
		header('Location: http://localhost/medt/Ue8/SessionsHue/index.php?logout');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>Projekte</title>
		<style></style>
	</head>
	<body>
		<div class="container">
		<?php
		$host='localhost';
		$dbname= 'medt-3';
		$user='root';
		$pwd='';
		
		try{
		$db=new PDO ("mysql:host=$host;dbname=$dbname", $user, $pwd);
		}
		catch(PDOException $e)
		{
			exit("<p>DB nicht verfügbar: $e -> getMessage()</p>"); //$e nie in Produktionsumgebung
			
		}
		if($db==true)
		{
			
			
		}
		
		if(isset($_POST['createProj']))
		{
			if(!isset($_POST['btnErstellen']))
			{
		echo "<form method=\"POST\">
			  <h3>Neues Projekt erstellen</h3><br>
			  <label>Projectname: <input type=\"text\" name=\"projName\" required></label><br><br>
			  <label>Beschreibung: <input type=\"text\" style=\"width:400px;\" name=\"projDescription\"></label><br><br>
			  <label>Datum: <input type=\"date\" name=\"projDate\"></label><br><br>
			  <input type=\"submit\" name=\"btnErstellen\" value=\"Projekt Erstellen\"><br><br>
			  </form>";
			}else{
			$ins= $db->prepare("INSERT INTO project (name, description, createDate) VALUES (?,?,?)");
				$ins->bind_param("ss",$_POST['projName'], $_POST['projDescription'], $_POST['projDate']);
				
			}
			
			
			
		}
		if(isset($_GET['trashID'])){
				$q=$db->prepare("DELETE FROM project WHERE id=:projID");
				$q->bindParam(':projID', $_GET['trashID'], PDO::PARAM_STR);
				$q->execute();
				$count= $q ->rowCount();
				if($count=1){
					echo "<br><p class=\"bg-success\">Löschen war erfolgreich!</p>";
				}else{
					echo '<br><p class="bg-danger">Löschen war nicht erfolgreich!</p>';
				}
		}
		if(isset($_GET['editID']) || isset($_POST['editID'])){
		if(!isset($_POST['btnSubmit'])){
			$res= $db -> prepare('SELECT name, description, id, createDate FROM project WHERE id=:projID');
			$res->bindParam(':projID',$_GET['editID'],PDO::PARAM_INT);
			$res->execute();
			$result = $res->fetch(PDO::FETCH_OBJ);	
				echo "<h3><span style =\"margin-right:20px;\"class=\"glyphicon glyphicon-edit\"></span>Projekt Editieren</h3><br><form method=\"POST\"action=\"index.php\">
					<label>Titel: <input type=\"text\" name=\"editedName\" value=\"$result->name\" required></label><br><br>
					<label>Beschreibung: <input type=\"text\" style=\"width:400px;\" name=\"editedDescription\" value=\"$result->description\"></label><br><br>
					<label>Datum: <input type=\"date\" name=\"editedDate\" value=\"$result->createDate\"></label><br><br>
					<input type=\"submit\" name=\"btnSubmit\" value=\"Speichern\"><br>
					<input type=\"text\" name=\"editID\" value=\"".$_GET['editID']."\" hidden>
					</form><hr></hr>";
				}else{
				$query=$db->prepare("UPDATE project SET name=:projname, description=:projdesc, createDate=:projDate WHERE id=:projeditID");
				$query->bindParam(':projname', $_POST['editedName'], PDO::PARAM_STR);
				$query->bindParam(':projdesc', $_POST['editedDescription'], PDO::PARAM_STR);
				$query->bindParam(':projDate', $_POST['editedDate']);
				$query->bindParam(':projeditID', $_POST['editID'], PDO::PARAM_INT);
				$query->execute();
				}
		}
		
		
		$res= $db -> query("SELECT name, description, id, createDate FROM project");
		$tmp = $res->fetchAll(PDO::FETCH_OBJ);
		//print_r($tmp);
//HÜ Projekt erstellen button, funktions 		
		
		?>
		<h2><span style="margin-right:15px;" class="glyphicon glyphicon-home"></span>Projektübersicht</h2><br>
			<form action="#" method="POST">
				<input type="submit" name="createProj" value="Projekt erstellen">
				<input type="submit" name="logOut" value="Abmelden">
			</form>
			<table class="table">
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>CreateDate</th>
					<th>Operationen</th>
				</tr>

				
				<?php 
					foreach($tmp as $items){
						$itemID=$items->id;
						echo "<tr><td>$items->name</td>";
						echo "<td>$items->description</td>";
						echo "<td>$items->createDate</td>";
						echo "<td><a style=\" margin-right:20px;\" href=\"index.php?editID=$itemID\"><span  class=\"glyphicon glyphicon-edit\"></span></a><a href=\"index.php?trashID=$itemID\"><span class=\"glyphicon glyphicon-trash\"></span></a></td></tr>";
				}
				?>
			</table>
		</div>
	</body>
</html>
