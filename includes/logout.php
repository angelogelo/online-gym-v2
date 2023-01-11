<?php  
	
	session_start();

	unset($_SESSION['admin']);
	header('location: ../index.php');

	unset($_SESSION['coach']);
	header('location: ../index.php');

	unset($_SESSION['client']);
	header("location: ../index.php");

?>