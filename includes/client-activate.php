<?php

	include 'connection.php';

    $updated_id = $_POST['update_id'];
    $status = 'active';

    $update = $connection->query("UPDATE client SET
        status = '$status'
        WHERE client_id = '$updated_id'
        ");

    if($update === "TRUE"){

        $update = $connection->query("UPDATE user SET
            status = '$status'
            WHERE username = '$updated_id'
        ");

        echo "Updated";
    }

	
?>