<?php  
	
	include 'connection.php';

	$id = $_POST['id'];

	$delete = $connection->query("DELETE FROM announcement WHERE id='$id'");
    echo "Deleted";

?>