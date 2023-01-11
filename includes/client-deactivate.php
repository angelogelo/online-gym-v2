<?php

	include 'connection.php';

    $update_id = $_POST['update_id'];
    $status = 'deactivated';

    $update = $connection->query("UPDATE client SET
        status = '$status'
        WHERE client_id = '$update_id'
        ");

    if($update === "TRUE"){

        $update = $connection->query("UPDATE user SET
            status = '$status'
            WHERE username = '$update_id'
        ");

        echo "Updated";
    }

	
?>