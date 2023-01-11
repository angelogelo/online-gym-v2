<?php
	
	include 'connection.php';

	$skills_name = $_POST['skills_name'];

	$selectSkills = $connection->query("SELECT * FROM skills WHERE skills_name = '".$skills_name."'");
	
	if($selectSkills->num_rows < 1){
		
		$insert = $connection->query("INSERT INTO skills (
			skills_name, 
			created_at
		) VALUES (
			'$skills_name', 
			'$timeNow'
		)");

		echo "Insert";

	}else{
		echo "Taken";
	}

?>