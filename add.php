<?php 
	require_once('functions.php'); 

	if(empty($_POST['lead'])){
		echo "No arguments Provided!";
		return false;
	}

	add();
?>
