<?php
    session_start();
    if(((!isset($_SESSION['email']))) && ((!isset($_SESSION['senha'])))){
        unset($_SESSION["email"]);
        unset($_SESSION["senha"]);
        header('Location: index.php');
        session_destroy();
        exit;
    } 
    if($_SESSION['tipo'] != 'professor'){
		unset($_SESSION["email"]);
        unset($_SESSION["senha"]);
		header('Location: index.php');
		session_destroy();
		exit();	
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>CICLO</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link rel="shortcut icon" href="imagem/favicon.ico" type="image/x-icon">
        <link href="css/styles.css" rel="stylesheet" /> 
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">