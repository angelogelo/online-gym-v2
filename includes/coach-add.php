<?php

	include 'connection.php';

	$picture_tmp = $_FILES['picture']['tmp_name'];
	$picture_name = $_FILES['picture']['name'];
	$picture = time()."_".$picture_name;

	$firstname 			= $_POST['firstname'];
	$middlename 		= $_POST['middlename'];
	$lastname 			= $_POST['lastname'];
	$gender 			= $_POST['gender'];
	$birthDate 			= $_POST['birthDate'];
	$contact_no 		= $_POST['contact_no'];
	$address 			= $_POST['address'];
	$coach_skills_id	= $_POST['coach_skills_id'];
	$password 			= password_hash(strtolower($contact_no), PASSWORD_DEFAULT);

	$coach_id = mt_rand();

	$type = "coach";
	
	$select_contact_no = $connection->query("SELECT * FROM coach WHERE contact_no = '".$contact_no."'");

	if ($select_contact_no->num_rows < 1) {
		
		if ($picture_tmp !== "") {

			if (move_uploaded_file($picture_tmp, '../images/coach/'.$picture)) {

				$insert = $connection->query("INSERT INTO coach(
					picture, 
					coach_id, 
					coach_skills_id, 
					firstname, 
					middlename, 
					lastname, 
					gender, 
					birthDate, 
					address, 
					contact_no,
				   	type, 
					created_at
				) VALUES (
					'$picture',
					'$coach_id',
					'$coach_skills_id', 
					'$firstname',
					'$middlename',
					'$lastname',
					'$gender',
					'$birthDate',
					'$address',
					'$contact_no',
					'$type',
					'$timeNow'
				)");

				$insertUser = $connection->query("INSERT INTO user (
					username, 
					password, 
					picture, 
					type, 
					contact_no, 
					created_at
				) VALUES (
					'$coach_id',
					'$password',
					'$picture',
					'$type',
					'$contact_no',
					'$timeNow'
				)");

				echo "Inserted";

			}else{
				echo "Image Failed";
			}
			
		}else{

			$insert = $connection->query("INSERT INTO coach(
				coach_id, 
				coach_skills_id, 
				firstname, 
				middlename, 
				lastname, 
				gender, 
				birthDate, 
				address, 
				contact_no,
				type, 
				created_at
			) VALUES (
				'$coach_id',
				'$coach_skills_id', 
				'$firstname',
				'$middlename',
				'$lastname',
				'$gender',
				'$birthDate',
				'$address',
				'$contact_no',
				'$type',
				'$timeNow'
			)");

			$insertUser = $connection->query("INSERT INTO user (
				username, 
				password, 
				type, 
				contact_no, 
				created_at
			) VALUES (
				'$coach_id',
				'$password',
				'$type',
				'$contact_no',
				'$timeNow'
			)");
			
			echo "InserteD";
		}

	}else{
		echo "Contact Taken";
	}
?>