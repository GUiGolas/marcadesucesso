<?php 
  require_once('functions.php'); 

  if(empty($_POST['name'])      ||
	empty($_POST['email'])     ||
	empty($_POST['phone'])     ||
	empty($_POST['message'])   ||
	!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		echo "No arguments Provided!";
		return false;
	}


  add();
?>