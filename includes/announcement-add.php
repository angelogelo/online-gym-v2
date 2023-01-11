<?php  
	
	include 'connection.php';

	$title = $_POST['title'];
	$description = $_POST['description'];
	$created_at = $_POST['created_at'];
	
	$insert = $connection->query("INSERT INTO announcement (
            title, 
            description,
            created_at
        ) VALUES (
            '$title',
            '$description',
            '$created_at'
        )");

    echo "Added";
?>