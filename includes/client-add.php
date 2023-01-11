<?php

	include 'connection.php';

	$picture_tmp 	= $_FILES['picture']['tmp_name'];
	$picture_name 	= $_FILES['picture']['name'];
	$picture 		= time()."_".$picture_name;
	
	$firstname 		= $_POST['firstname'];
	$middlename 	= $_POST['middlename'];
	$lastname 		= $_POST['lastname'];
	$gender 		= $_POST['gender'];
	$birthDate 		= $_POST['birthDate'];
	$contact_no 	= $_POST['contact_no'];
	$address 		= $_POST['address'];
	$height	 		= $_POST['height'];
	$weight 		= $_POST['weight'];
	$password 		= password_hash(strtolower($contact_no), PASSWORD_DEFAULT);

	$totalHeight 	= $height/100*$height/100;
	$totalBMI 		= $weight/$totalHeight;

	$finalTotal 	= number_format($totalBMI, 2);
	$client_id 		= mt_rand();
	$type 			= "client";

	$select_contact_no = $connection->query("SELECT * FROM client WHERE contact_no = '".$contact_no."'");

	if($select_contact_no->num_rows < 1){

		if($picture_tmp !== ""){

			if(move_uploaded_file($picture_tmp, '../images/client/'.$picture)){

				$insert = $connection->query("INSERT INTO client (
					picture, 
	 				client_id, 
	 				firstname, 
	 				middlename, 
	 				lastname, 
	 				gender, 
					birthDate, 
	 				height, 
	 				weight, 
	 				bmi, 
	 				address, 
	 				contact_no,
	 			   	type, 
	 				created_at
				) VALUES (
					'$picture',
					'$client_id',
					'$firstname',
					'$middlename',
					'$lastname',
					'$gender',
					'$birthDate',
					'$height',
					'$weight',
					'$finalTotal',
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
					'$client_id',
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

			$insert2 = $connetion->query("INSERT INTO client (
				client_id, 
				firstname, 
				middlename, 
				lastname, 
				gender, 
				birthDate, 
				height, 
				weight, 
				bmi, 
				address, 
				contact_no,
				type, 
				created_at
			) VALUES (
				'$client_id',
				'$firstname',
				'$middlename',
				'$lastname',
				'$gender',
				'$birthDate',
				'$height',
				'$weight',
				'$finalTotal',
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
				'$client_id',
				'$password',
				'$picture',
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