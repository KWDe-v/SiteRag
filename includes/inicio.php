<?php
$title = 'Inicio';
if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
	header('Location: ?to=entrar&RedirectURL=inicio');
}else{
	$user = $_SESSION['user'];
}



?> 