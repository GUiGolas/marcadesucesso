<?php 
	require_once('functions.php'); 

	if(empty($_POST['name'])   ||
	empty($_POST['email'])     ||
	empty($_POST['phone'])     ||
	!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		echo "No arguments Provided!";
		return false;
	}

	add();
?>