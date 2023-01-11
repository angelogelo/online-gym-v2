<?php
	
	include 'connection.php';

	$client_id 			= 	$_POST['client_id'];
	$membership_id 		= 	$_POST['membership_id'];
	$coach_id 			= 	$_POST['coach_id'];
	$membership_cost 	= 	$_POST['membership_cost'];
	$registration_date 	= 	$_POST['registration_date'];
	$start_date 		= 	$_POST['start_date'];
	$end_date 			= 	$_POST['end_date'];
	$remark				= 	$_POST['remark'];
    
	$select = $connection->query("SELECT * FROM subscriptions WHERE client_id = '".$client_id."'");

	if($coach_id != ""){

		if($select->num_rows < 1){

			$insert = $connection->query("INSERT INTO subscriptions (
				client_id,
				coach_id,
				membership_id,
				membership_cost,
				registration_date,
				start_date,
				end_date,
				remark,
				created_at
			) VALUES (
				'$client_id',
				'$coach_id',
				'$membership_id',
				'$membership_cost',
				'$registration_date',
				'$start_date',
				'$end_date',
				'$remark',
				'$timeNow'
			)");
			echo "Insert";
				
		}else{
			echo "Taken";
		}

	}else{

		if($select->num_rows < 1){

			$insert2 = $connection->query("INSERT INTO subscriptions (
				client_id,
				membership_id,
				membership_cost,
				registration_date,
				start_date,
				end_date,
				remark,
				created_at
			) VALUES (
				'$client_id',
				'$membership_id',
				'$membership_cost',
				'$registration_date',
				'$start_date',
				'$end_date',
				'$remark',
				'$timeNow'
			)");

			echo "Insert";
				
		}else{
				echo "Taken";
		}

	}

	

	


?>