<?php  
	
	include 'connection.php';

	$update_id = $_POST['update_id'];
	$skills_name = $_POST['skills_name'];

	$update = $connection->query("UPDATE skills SET
            skills_name = '$skills_name'
        WHERE id 	= '$update_id'
    ");

	echo "Updated";
    
?>