<?php
	session_start();	
	if($_SESSION['tipo'] != 'professor'){
		unset($_SESSION["email"]);
        unset($_SESSION["senha"]);
		header('Location: index.php');
		session_destroy();
		exit();	
	}
	
?>
