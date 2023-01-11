<?php  
	
	include 'connection.php';

	$update_id = $_POST['update_id'];
	$edit_contact_no = $_POST['edit_contact_no'];
	$edit_social_media = $_POST['edit_social_media'];
	$edit_email = $_POST['edit_email'];

    $update = $connection->query("UPDATE contact SET 
            contact_no = '$edit_contact_no',
            social_media = '$edit_social_media',
            email = '$edit_email'
        WHERE id 	= '$update_id'
    ");

    echo "Updated";
?>