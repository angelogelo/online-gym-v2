<?php  
	
	include'connection.php';

	$picture_tmp = $_FILES['picture']['tmp_name'];
	$picture_name = $_FILES['picture']['name'];
	$picture = time()."_".$picture_name;

	$update_id 			= $_POST['update_id'];
	$firstname 			= $_POST['firstname'];
	$middlename 		= $_POST['middlename'];
	$lastname 			= $_POST['lastname'];
	$gender 			= $_POST['gender'];
	$birthDate 			= $_POST['birthDate'];
	$contact_no 		= $_POST['contact_no'];
	$address 			= $_POST['address'];
	$coach_skills_id	= $_POST['coach_skills'];
	
	if ($picture_tmp !== "") {
		
		if (move_uploaded_file($picture_tmp, '../images/coach/'.$picture)) {

			$update = $connection->query("UPDATE coach SET
				picture 		= '$picture',
				coach_skills_id	= '$coach_skills_id',
				firstname 		= '$firstname',
				middlename 		= '$middlename',
				lastname 		= '$lastname',
				gender 			= '$gender',
				birthDate 		= '$birthDate',
				contact_no 		= '$contact_no',
				address 		= '$address'
				WHERE id 		= '$update_id'
			");
			echo "Updated";

		}else{
			echo "Failed";
		}
	}else{

		$update1 = $connection->query("UPDATE coach SET
			coach_skills_id	= '$coach_skills_id',
			firstname 		= '$firstname',
			middlename 		= '$middlename',
			lastname 		= '$lastname',
			gender 			= '$gender',
			birthDate 		= '$birthDate',
			contact_no 		= '$contact_no',
			address 		= '$address'
			WHERE id 		= '$update_id'
		");
		echo "Updated";
	}


?>