<?php 
  $page = 'membership';
	include 'header.php';
	$id = $_GET['id'];
	//$id = urldecode(base64_decode($id));
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Check Who Has Avail This Membership Plan</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">

    <div class="card card-warning card-outline">
      <div class="card-body">
        <table id="checkAvailTable" class="table table-bordered table-hover text-nowrap table-sm">
          <thead>
            <tr>
              <th class="table-plus datatable-nosort" >No</th>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
		  	<?php

          $number = 1;
          // $selectClient = $pdo->prepare("SELECT * FROM subscriptions WHERE membership_id = '".$id."'");
          // while($selectClientData = $selectClient->fetch(PDO::FETCH_ASSOC)){						
          $selectClient = $connection->query("SELECT * FROM subscriptions WHERE membership_id = '".$id."'");
          while($selectClientData = $selectClient->fetch_array()){	

            // $client = $pdo->prepare("SELECT * FROM client WHERE client_id = '".$selectClientData['client_id']."'");
            // $client->execute();
            // $clientData = $client->fetch(PDO::FETCH_ASSOC);

            $client = $connection->query("SELECT * FROM client WHERE client_id = '".$selectClientData['client_id']."'");
            $clientData = $client->fetch_array();

            $fullname = $clientData['firstname']." ".$clientData['middlename']." ".$clientData['lastname'];
          
        ?>
            <tr>
              <td><?= $number++; ?></td>
              <td><?= $fullname; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div><!-- /.card-body -->
    </div><!-- /.card -->
    
  </div><!-- /.container-fluid -->
</div><!-- /.content -->


<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $('#checkAvailTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


