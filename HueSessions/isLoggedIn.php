<?php
	session_start();
	if(!isset($_SESSION["username"]))
	{
		header('Location: http://localhost/medt/Ue8/SessionsHue/index.php');
	}
?>
