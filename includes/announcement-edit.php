<?php  
	
	include 'connection.php';

	$update_id = $_POST['update_id'];
	$title = $_POST['edit_title'];
	$description = $_POST['edit_description'];
	$created_at = $_POST['edit_created_at'];

	$update = $connection->query("UPDATE announcement SET
            title 	    = '$title',
            description = '$description',
            created_at 	= '$created_at'
        WHERE id 	= '$update_id'
    ");

	echo "Updated";
?>