<?php  
	
	include 'connection.php';

	$update_id = $_POST['update_id'];
	$gym_name = $_POST['edit_gym_name'];
	$gym_address = $_POST['edit_gym_address'];
	$mission = $_POST['edit_mission'];
	$vision = $_POST['edit_vision'];

    $update = $connection->query("UPDATE about SET 
            gym_name = '$gym_name',
            gym_address = '$gym_address',
            mission = '$mission',
            vision = '$vision'
        WHERE id 	= '$update_id'
    ");

    echo "Updated";
?>