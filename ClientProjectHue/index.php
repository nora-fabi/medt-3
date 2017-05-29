	<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>index</title>
		<style>
			.glyphicon{margin-right:20px;}
			.box{
				font-size: 1.2em;
				height: 50px;
			}
		</style>
		<script
			src="https://code.jquery.com/jquery-3.2.1.min.js"
			integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			crossorigin="anonymous">
		</script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>
	<body>
	<?php require "api/db.php" ?>
  <!-- db.php => <php try, catch, stuff ?>
		index.php, api.php => require db.php-->
		<div class="container">
		<script>
		var currentProID;
		var currentrow;
		$(document).ready(function(){
			$('#msgBox').hide();
			$('.trashclass').click(function(){
				currentProID = $(this).parent().parent().attr('id');
				$('#myModal').modal('show');
			});
			$('.editclass').click(function(){
				currentrow = $(this).parent().parent();
				currentProID = $(this).parent().parent().attr('id');
				$('#editModal').modal('show');
				$("#project-name").val(currentrow.children('.NameOfProject').html());
				$('#description-text').val(currentrow.children('.DescriptionOfProject').html());
				$('#project-date').val(currentrow.children('.DateOfProject').html());
			});
			$('.saveChanges').click(function(){
				var AjaxConfigObj={
					url: "http://localhost/medt/Ue8/Ue8splited/api/trackstart.php",
					type: "post",
					data: {"projectToEdit" : currentProID, "editedName" : $("#project-name").val(), "editedDescription" : $("#description-text").val(), "editedDate" : $("#project-date").val()},
					dataType: "json",
					success: function(dataFromServer, textStatus, jqXHR){
					console.log("Server response: "+ dataFromServer.edit);
					if(dataFromServer.edit){
						currentrow.children('.NameOfProject').html($('#project-name').val());
						currentrow.children('.DescriptionOfProject').html($('#description-text').val());
						currentrow.children('.DateOfProject').html($('#project-date').val());
						$('#msgBox').text("Änderung erfolgreich!").addClass("bg-success").show(500).delay(2000).hide(200);
					}
					else{
						$('#msgBox').text("Änderung fehlgeschlagen!").addClass("bg-danger").show(500).delay(2000).hide(200);
					}
					},
					error: function(jqXHR,msg){
						console.log("Server response: " + msg);
						//Leere Nachrichten-Box bereitstellen, wird kontextabhängig enthüllt und gestaltet
						$('#msgBox').text("Server nicht verfügbar").addClass("bg-danger").show(500).delay(2000).hide(200);
				
				}};
				$.ajax(AjaxConfigObj);
				$('#editModal').modal('hide');
			});
			$('#deleteProject').click(function(){			
				// AJAX call konfigurieren
				var myAjaxConfigObj ={
					url: "http://localhost/medt/Ue8/Ue8splited/api/trackstart.php", //Default: the current page
					type: "post", //Unbedingt klein schreiben(type)
					//ohne jquery: this.parent().parent().id würde nicht funken
					data: {"projectToDelete" : currentProID}, 
					dataType:"json",
					success: function(dataFromServer, textStatus, jqXHR){
						console.log("Server response: " + dataFromServer.delete);
						if(dataFromServer.delete){
							$("#" + currentProID).remove();
							$('#msgBox').text("Löschen erfolgreich!").addClass("bg-success").show(500).delay(2000).hide(200);
						//gelöscht: Zeile mit ProjektID aus der HTML entfernen($(..).remove()) und Meldung mit msgBox (CSS nicht vergessen)
						}
						else{
							$('#msgBox').text("Server nicht verfügbar").addClass("bg-danger").show(500).delay(2000).hide(200);//msgBox mit fehlermeldung (CSS nicht vergessen)
						}
					},
					//ist das Ziel wenn HTTP respose nicht vom Statuscode 200 ist
					error: function(jqXHR,msg){
						console.log("Server response: " + msg);
						//Leere Nachrichten-Box bereitstellen, wird kontextabhängig enthüllt und gestaltet
						$('#msgBox').text("Server nicht verfügbar").addClass("bg-danger").show(500).delay(2000).hide(200);
					}
				}
				//AJAX call absetzen
				$.ajax(myAjaxConfigObj);
				$('#myModal').modal('hide');
			});
		});
		</script> 
		
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Modal title</h4>
				</div>
      <div class="modal-body">
        <p>Sind Sie sich wirklich sicher, dass sie das Projekt löschen wollen?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zurück</button>
        <button type="button" class="btn btn-primary" id="deleteProject">Ja</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Projekt Ändern</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="project-name" class="control-label">Projekt Name:</label>
            <input type="text" class="form-control" id="project-name">
          </div>
          <div class="form-group">
            <label for="description-text" class="control-label">Beschreibung:</label>
            <textarea class="form-control" id="description-text"></textarea>
          </div>
		  <div class="form-group">
            <label for="project-date" class="control-label">Datum:</label>
            <input type="date" class="form-control" id="project-date">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zurück</button>
        <button type="button" class="btn btn-primary saveChanges">Speichern</button>
      </div>
    </div>
  </div>
</div>

		<h2><span style="margin-right:15px;" class="glyphicon glyphicon-home"></span>Projektübersicht</h2><br>
		<p id="msgBox" class="box"></p>
			<table class="table">
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>CreateDate</th>
					<th>Operationen</th>
				</tr>

				
				<?php 
				
					$res= $db -> query("SELECT name, description, id, createDate FROM project");
					$tmp = $res->fetchAll(PDO::FETCH_OBJ);	
					foreach($tmp as $items){
						$itemID=$items->id;
					echo "<tr id=\"$items->id\">
					<td class=\"NameOfProject\">$items->name</td>";
						echo "<td class=\"DescriptionOfProject\">$items->description</td>";
						echo "<td class=\"DateOfProject\">$items->createDate</td>";
						//Mit HTML 5 eigene Attribute möglich data-xyz Bsp: data-name 
					echo "<td><span class=\"glyphicon glyphicon-edit editclass\"></span><span data-remove=\"$itemID\" class=\"glyphicon glyphicon-trash trashclass\"></td></tr>";
				}
				?>
			</table>
		</div>
	</body>
</html>
