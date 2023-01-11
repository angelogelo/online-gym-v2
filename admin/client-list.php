<?php
  $page = 'client-list';
  include 'header.php'; 
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Client List</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">

    <div class="card card-warning card-outline">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-bar mr-1"></i>
          List of Client
        </h3>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">Active Client</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">Inactive Client</a>
          </li>
        </ul>
        <div class="tab-content" id="custom-content-above-tabContent">

          <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab"><hr>
            <!-- Active Client -->
            <table id="clientsTable" class="table table-bordered table-hover text-nowrap table-sm">
              <thead>
              <tr>
                <th class="table-plus datatable-nosort" >No</th>
                <th>Status</th>
                <th>Photo</th>
                <th>Member ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>BMI</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>

                <?php

                  $client = $connection->query("SELECT * FROM client WHERE status = 'active'");
                  $number = 1;
                  while($clientData = $client->fetch_array()){

                    $birthDate = new DateTime($clientData['birthDate']);
                    $age = $birthDate->diff(new DateTime);

                    $id = $clientData['id'];
                  
                ?>
                <tr>
                  <td> <?= $number++; ?> </td>
                  <td> 

                    <?php  
                      if ($clientData['status'] == "active") {
                        ?>
                          <span class="text-success">Active</span>
                        <?php
                      }else {
                        ?>
                          <span class="text-warning">Deactivated</span>
                        <?php
                      }
                    ?>
                      

                  </td>
                  <td> 

                    <?php  
                      if ($clientData['picture'] == "none" || $clientData['picture'] == NULL) {
                        ?>
                          <img src="/images/no_image.png" class="img-fluid rounded" style="width: 40px; height: 30px;">
                        <?php
                      }else {
                        ?>
                          <img src="/images/client/<?php echo $clientData['picture']; ?>" class="img-fluid rounded" style="width: 40px; height: 30px;">
                        <?php
                      }
                    ?>

                  </td>
                  <td> <?= $clientData['client_id']; ?> </td>
                  <td> <?php echo $clientData['lastname'].", ".$clientData['firstname']." ".$clientData['middlename']; ?> </td>
                  <td> <?= $age->y; ?> </td>
                  <td> <?= $clientData['bmi']; ?></td>
                  <td>

                    <!-- View -->
                    <button class="btn btn-outline-primary btn-xs viewClient" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $clientData['id']; ?>"><i class="fas fa-eye"></i></button>

                    <!-- Edit -->
                    <!-- <a href="/client-edit/.'$id'.; ?>" class="btn btn-outline-success btn-xs" data-tooltip="tooltip" title="Click to Edit">
                      <i class="fa fa-edit"></i>
                    </a> -->
                    <button class="btn btn-outline-success btn-xs edit-client" data-tooltip="tooltip" title="Click to Edit" data-id="<?php echo $clientData['id']; ?>"><i class="fas fa-edit"></i></button>

                    <!-- Delete -->
                    <!-- <button type="button" class="btn btn-outline-danger btn-xs deleteClient" data-id="<?php //echo $clientData['client_id']; ?>"><i class="fa fa-trash-alt"></i></button> -->

                    <!-- Status -->
                    <button type="button" class="btn btn-outline-warning btn-xs" data-toggle="modal" data-target="#deactivate<?= $clientData['client_id']; ?>"><i class="fas fa-exchange-alt" data-toggle="tooltip" data-placement="top" title="Click to Change Status"></i></button>
                  </td>
                </tr>

                <div class="modal fade" id="deactivate<?= $clientData['client_id']; ?>">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <form action="" method="POST" class="deactivateForm" id="deactivateForm<?= $clientData['client_id']; ?>" data-id="<?= $clientData['client_id']; ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                          <h6 style="text-align: center;">
                            Are you sure you want to deactivate this employee?
                          </h6>
                        </div>
                        <div class="modal-footer">
                          <input type="hidden" name="update_id" value="<?php echo $clientData['client_id']; ?>">
                          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-primary btn-xs">Yes</button>
                        </div>
                      </form>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <div class="modal fade" id="viewClient<?php echo $clientData['id']; ?>">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">
                          <i class="fas fa-info-circle"></i> Client Information
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="card card-warning card-outline">
                              <div class="modal-header">
                                <h4 class="modal-title">
                                  <i class="fas fa-info-circle"></i> About Me
                                </h4>
                              </div>
                              <div class="card-body box-profile">
                                <div class="form-group">
                                  <div class="text-center">
                                    <?php  
                                      if ($clientData['picture'] == "none" || $clientData['picture'] == NULL) {
                                        ?>
                                          <img src="/images/no_image.png" class="profile-user-img img-fluid img-circle">
                                        <?php
                                      }else {
                                        ?>
                                          <img src="/images/client/<?= $clientData['picture']; ?>" class="profile-user-img img-fluid img-circle">
                                        <?php
                                      }
                                    ?>
                                  </div>

                                  <h3 class="profile-username text-center" style="font-size: 20px;"><?= $clientData['firstname']." ".$clientData['middlename']." ".$clientData['lastname']; ?></h3>

                                  <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                      <i class="fas fa-info text-sm"></i> <b>Status</b>
                                      <a class="float-right">
                                        <?php  
                                          if ($clientData['status'] == "active") {
                                            ?>
                                              <i class="fas fa-circle text-success"></i>
                                            <?php
                                          }else {
                                            ?>
                                              <i class="fas fa-circle text-danger"></i>
                                            <?php
                                          }
                                        ?>
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div><!-- /.card-body -->
                          </div><!-- /.col -->

                          <div class="col-lg-8">
                            <div class="card card-warning card-outline">
                              <div class="card-header">
                                <h4 class="card-title">Contact Details</h4>
                              </div>
                              <div class="card-body">
                                
                                <ul class="list-group list-group-unbordered mb-3">
                                  <li class="list-group-item">
                                    <i class="fas fa-venus-mars text-sm"></i> <b>Gender</b>
                                      <a class="float-right">
                                        <?= $clientData['gender']; ?>
                                      </a>
                                  </li>
                                  <li class="list-group-item">
                                    <i class="fas fa-phone text-sm"></i> <b>Phone Number</b>
                                    <a class="float-right">
                                      <?= $clientData['contact_no']; ?>
                                    </a>
                                  </li>
                                  <li class="list-group-item">
                                    <i class="fas fa-ruler-vertical text-sm"></i> <b>Height</b>
                                    <a class="float-right">
                                      <?= $clientData['height']; ?> cm
                                    </a>
                                  </li>
                                  <li class="list-group-item">
                                    <i class="fas fa-weight text-sm"></i> <b>Weight</b>
                                    <a class="float-right">
                                      <?= $clientData['weight']; ?> kg
                                    </a>
                                  </li>
                                  <li class="list-group-item">
                                    <i class="fas fa-child text-sm"></i> <b>BMI</b>
                                    <a class="float-right">
                                      <?= $clientData['bmi']; ?>
                                    </a>
                                  </li>
                                  <li class="list-group-item">
                                    <i class="fas fa-map-marked-alt text-sm"></i> <b>Address</b>
                                    <a class="float-right">
                                      <?= $clientData['address']; ?>
                                    </a>
                                  </li>
                                </ul>

                              </div><!-- /.card-body -->
                            </div><!-- /.card -->
                          </div><!-- /.col -->

                        </div><!-- /.row -->
                      </div><!-- /.modal-body -->
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <?php } ?>
              </tbody>
            </table>
          </div>

          <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab"><hr>
            <!-- Deactivate Client -->
            <table id="clientsdeactivateTable" class="table table-bordered table-hover text-nowrap table-sm">
              <thead>
              <tr>
                <th class="table-plus datatable-nosort" >No</th>
                <th>Status</th>
                <th>Photo</th>
                <th>Member ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>BMI</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>

                <?php

                    $client = $connection->query("SELECT * FROM client WHERE status = 'deactivated'");
                    $number = 1;
                    while($clientData = $client->fetch_array()){

                    $birthDate = new DateTime($clientData['birthDate']);
                    $age = $birthDate->diff(new DateTime);

                    $id = $clientData['id'];
                  
                ?>
                <tr>
                  <td> <?= $number++; ?> </td>
                  <td> 

                    <?php  
                      if ($clientData['status'] == "active") {
                        ?>
                          <span class="text-success">Active</span>
                        <?php
                      }else {
                        ?>
                          <span class="text-warning">Deactivated</span>
                        <?php
                      }
                    ?>
                      

                  </td>
                  <td> 

                    <?php  
                      if ($clientData['picture'] == "none" || $clientData['picture'] == NULL) {
                        ?>
                          <img src="/images/no_image.png" class="img-fluid rounded" style="width: 40px; height: 30px;">
                        <?php
                      }else {
                        ?>
                          <img src="/images/client/<?php echo $clientData['picture']; ?>" class="img-fluid rounded" style="width: 40px; height: 30px;">
                        <?php
                      }
                    ?>

                  </td>
                  <td> <?= $clientData['client_id']; ?> </td>
                  <td> <?php echo $clientData['lastname'].", ".$clientData['firstname']." ".$clientData['middlename']; ?> </td>
                  <td> <?= $age->y; ?> </td>
                  <td> <?= $clientData['bmi']; ?></td>
                  <td>

                    <!-- View -->
                    <button class="btn btn-outline-primary btn-xs viewClient" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $clientData['id']; ?>"><i class="fas fa-eye"></i></button>

                    <!-- Edit -->
                    <button class="btn btn-outline-success btn-xs edit-client" data-tooltip="tooltip" title="Click to Edit" data-id="<?php echo $clientData['id']; ?>"><i class="fas fa-edit"></i></button>

                    <!-- Delete -->
                    <!-- <button type="button" class="btn btn-outline-danger btn-xs deleteClient" data-id="<?php //echo $clientData['client_id']; ?>"><i class="fa fa-trash-alt"></i></button> -->

                    <!-- Status -->
                    <button type="button" class="btn btn-outline-warning btn-xs" data-toggle="modal" data-target="#activate<?= $clientData['client_id']; ?>"><i class="fas fa-exchange-alt" data-toggle="tooltip" data-placement="top" title="Click to Change Status"></i></button>
                  </td>
                </tr>

                <div class="modal fade" id="activate<?= $clientData['client_id']; ?>">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <form action="" method="POST" class="activateForm" id="activateForm<?= $clientData['client_id']; ?>" data-id="<?= $clientData['client_id']; ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                          <h6 style="text-align: center;">
                            Are you sure you want to activate this employee?
                          </h6>
                        </div>
                        <div class="modal-footer">
                          <input type="hidden" name="update_id" value="<?php echo $clientData['client_id']; ?>">
                          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-primary btn-xs">Yes</button>
                        </div>
                      </form>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <div class="modal fade" id="viewClient<?php echo $clientData['id']; ?>">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">
                          <i class="fas fa-info-circle"></i> Client Information
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="card card-warning card-outline">
                              <div class="modal-header">
                                <h4 class="modal-title">
                                  <i class="fas fa-info-circle"></i> About Me
                                </h4>
                              </div>
                              <div class="card-body box-profile">
                                <div class="form-group">
                                  <div class="text-center">
                                    <?php  
                                      if ($clientData['picture'] == "none" || $clientData['picture'] == NULL) {
                                        ?>
                                          <img src="/images/no_image.png" class="profile-user-img img-fluid img-circle">
                                        <?php
                                      }else {
                                        ?>
                                          <img src="/images/client/<?= $clientData['picture']; ?>" class="profile-user-img img-fluid img-circle">
                                        <?php
                                      }
                                    ?>
                                  </div>

                                  <h3 class="profile-username text-center" style="font-size: 20px;"><?= $clientData['firstname']." ".$clientData['middlename']." ".$clientData['lastname']; ?></h3>

                                  <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                      <i class="fas fa-info text-sm"></i> <b>Status</b>
                                      <a class="float-right">
                                        <?php  
                                          if ($clientData['status'] == "active") {
                                            ?>
                                              <i class="fas fa-circle text-success"></i>
                                            <?php
                                          }else {
                                            ?>
                                              <i class="fas fa-circle text-danger"></i>
                                            <?php
                                          }
                                        ?>
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div><!-- /.card-body -->
                          </div><!-- /.col -->

                          <div class="col-lg-8">
                            <div class="card card-warning card-outline">
                              <div class="card-header">
                                <h4 class="card-title">Contact Details</h4>
                              </div>
                              <div class="card-body">
                                
                                <ul class="list-group list-group-unbordered mb-3">
                                  <li class="list-group-item">
                                    <i class="fas fa-venus-mars text-sm"></i> <b>Gender</b>
                                      <a class="float-right">
                                        <?= $clientData['gender']; ?>
                                      </a>
                                  </li>
                                  <li class="list-group-item">
                                    <i class="fas fa-phone text-sm"></i> <b>Phone Number</b>
                                    <a class="float-right">
                                      <?= $clientData['contact_no']; ?>
                                    </a>
                                  </li>
                                  <li class="list-group-item">
                                    <i class="fas fa-ruler-vertical text-sm"></i> <b>Height</b>
                                    <a class="float-right">
                                      <?= $clientData['height']; ?> cm
                                    </a>
                                  </li>
                                  <li class="list-group-item">
                                    <i class="fas fa-weight text-sm"></i> <b>Weight</b>
                                    <a class="float-right">
                                      <?= $clientData['weight']; ?> kg
                                    </a>
                                  </li>
                                  <li class="list-group-item">
                                    <i class="fas fa-child text-sm"></i> <b>BMI</b>
                                    <a class="float-right">
                                      <?= $clientData['bmi']; ?>
                                    </a>
                                  </li>
                                  <li class="list-group-item">
                                    <i class="fas fa-map-marked-alt text-sm"></i> <b>Address</b>
                                    <a class="float-right">
                                      <?= $clientData['address']; ?>
                                    </a>
                                  </li>
                                </ul>

                              </div><!-- /.card-body -->
                            </div><!-- /.card -->
                          </div><!-- /.col -->

                        </div><!-- /.row -->
                      </div><!-- /.modal-body -->
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <?php } ?>
              </tbody>
            </table>
          </div>

        </div>
      </div><!-- /.card-body -->
    </div><!-- /.card -->

  </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click', '.viewClient', function(){
      var id = $(this).attr('data-id');
      $('#viewClient'+id).modal('show');
    });

    $(document).on('click', '.edit-client', function(){
      var id = $(this).attr('data-id');
      window.location.href = 'client-edit.php?id='+id;
    });

    $(document).on('click', '.change-status', function(){
      var id = $(this).attr('data-id');
      $('#change-status'+id).modal('show');
    });

    $(document).on('click', '.change-status-activate', function(){
      var id = $(this).attr('data-id');
      $('#change-status-activate'+id).modal('show');
    });

    $('#clientsTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#clientsdeactivateTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $(document).on('submit', '.deactivateForm', function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var formData = new FormData($('#deactivateForm'+id)[0]);

      $.ajax({
        url: "../includes/client-deactivate.php",
        method: "POST",
        dataType: "TEXT",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          console.log(data);
          if (data == "Update Failed") {
            swal({
              icon: 'error',
              title: 'Failed to update status of client. Please try again later.'
            });
          }else {
            swal({
              icon: 'success',
              title: 'Client has been deactivated.'
            }).then(function(){
              location.reload();
            });
          }
        }
      })
    });

    $(document).on('submit', '.activateForm', function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var formData = new FormData($('#activateForm'+id)[0]);

      $.ajax({
        url: "../includes/client-activate.php",
        method: "POST",
        dataType: "TEXT",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          console.log(data);
          if (data == "Update Failed") {
            swal({
              icon: 'error',
              title: 'Failed to update status of client. Please try again later.'
            });
          }else {
            swal({
              icon: 'success',
              title: 'Client has been activated.'
            }).then(function(){
              location.reload();
            });
          }
        }
      })
    });

    // $('#changeStatus').submit(function(e){
    //   e.preventDefault();
    //   var formData = new FormData($(this)[0]);

    //   $.ajax({
    //     url: "/includes/client-deactivate.php",
    //     method: "POST",
    //     dataType: "TEXT",
    //     contentType: false,
    //     processData: false,
    //     data: formData,
    //     success: function(data){
    //       console.log(data);
    //       if (data == "Update Failed") {
    //         swal({
    //           icon: 'error',
    //           title: 'Failed to update status of client. Please try again later.'
    //         });
    //       }else {
    //         swal({
    //           icon: 'success',
    //           title: 'Client has been deactivated.'
    //         }).then(function(){
    //           location.reload();
    //         });
    //       }
    //     }
    //   })
    // });

    // $('#changeStatusActivate').submit(function(e){
    //   e.preventDefault();
    //   var formData = new FormData($(this)[0]);

    //   $.ajax({
    //     url: "/includes/client-activate.php",
    //     method: "POST",
    //     dataType: "TEXT",
    //     contentType: false,
    //     processData: false,
    //     data: formData,
    //     success: function(data){
    //       console.log(data);
    //       if (data == "Update Failed") {
    //         swal({
    //           icon: 'error',
    //           title: 'Failed to update status of client. Please try again later.'
    //         });
    //       }else {
    //         swal({
    //           icon: 'success',
    //           title: 'Client has been activated.'
    //         }).then(function(){
    //           location.reload();
    //         });
    //       }
    //     }
    //   })
    // });

    $(document).on('click', '.deleteClient', function() {
      var id = $(this).attr('data-id');
      swal({
        title: "Are you sure you want to delete this client?",
        text: "PROCEED WITH CAUTION!!!",
        icon: "info",
        buttons: {
          cancel: "Cancel",
          confirm: "Confirm"
        }
      }).then(function(event) {
        if (event == true) {
          $.ajax({
            url: "/includes/client-delete.php",
            method: "POST",
            dataType: "TEXT",
            data: {
              id: id
            }, success: function(data) {
              console.log(data);
              if (data === "Deleted") {
                swal({
                  title: "Client has been deleted!",
                  text: "You can't recover this deleted Client!",
                  icon: "info"
                }).then(function() {
                  location.reload();
                });
              } else {
                swal({
                  title: "Failed to delete this Client!",
                  icon: "info"
                });
              }
            }
          })
        }
      });
    });

  });
</script>