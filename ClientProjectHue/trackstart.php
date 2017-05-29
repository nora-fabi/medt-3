<?php 
		require "db.php";
		if(isset($_POST['projectToDelete'])){
				$q=$db->prepare("DELETE FROM project WHERE id=:projID");
				$q->bindParam(':projID', $_POST['projectToDelete'], PDO::PARAM_STR);
				$q->execute();
				$arr = array('delete' => 1);
				echo json_encode($arr);
				exit();
		}
		else if(isset($_POST['projectToEdit'])){
				$query=$db->prepare("UPDATE project SET name=:projname, description=:projdesc, createDate=:projDate WHERE id=:projeditID");
				$query->bindParam(':projname', $_POST['editedName'], PDO::PARAM_STR);
				$query->bindParam(':projdesc', $_POST['editedDescription'], PDO::PARAM_STR);
				$query->bindParam(':projDate', $_POST['editedDate']);
				$query->bindParam(':projeditID', $_POST['projectToEdit'], PDO::PARAM_INT);
				$query->execute();
				$arry = array('edit' => 1);
				echo json_encode($arry);
				exit();
				}
		
		?>
