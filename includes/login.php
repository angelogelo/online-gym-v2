<?php  

	include'connection.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql_user = $connection->query("SELECT
		*
		FROM user
		WHERE
			username = '".$username."'
	");

	if($sql_user->num_rows > 1){
		echo "No Account";
	}else{

		$userData = $sql_user->fetch_array();
		$passwordCheck = $userData['password'];

		$type = $userData['type'];

		if(password_verify($password, $passwordCheck)){

			if($type == "coach"){
				$_SESSION['coach'] = $username;

				$coach = $connection->query("SELECT
					*
					FROM coach
					WHERE
						 coach_id = '".$username."'
				");
				$coachData = $coach->fetch_array();

				if($coachData['status'] == "pending" OR $coachData['status'] == "deactivated"){
					echo "Pending";
					exit();
				}
				
			}else if ($type == "client"){
				$_SESSION['client'] = $username;

				$client = $connection->query("SELECT
					*
					FROM client
					WHERE
						 client_id = '".$username."'
				");
				$clientData = $client->fetch_array();

				if($clientData['status'] == "deactivated"){
					echo "Deactivated";
					exit();
				}
			}else {
				$_SESSION['admin'] = $username;
			}

			echo $type;

		}else{
			echo "No Account";
		}

	}

?>