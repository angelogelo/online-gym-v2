<?php
	
	include 'connection.php';

	$membership_name 	= $_POST['membership_name'];
	$price 				= $_POST['price'];
	$duration 			= $_POST['duration'];
	$details 			= $_POST['details'];

	$selectMembership = $connection->query("SELECT * FROM membership_plans WHERE duration = '".$duration."'");

	if ($selectMembership->num_rows < 1) {
		
		$insert = $connection->query("INSERT INTO membership_plans (
			membership_name,
			price,
			duration,
			details,
			created_at
		)VALUE (
			'$membership_name',
			'$price',
			'$duration',
			'$details',
			'$timeNow'
		)");

		echo "Insert";

	}else{
		echo "Taken";
	}

?>