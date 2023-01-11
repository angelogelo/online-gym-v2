<?php 
  $page = 'subscription-list';
  include 'header.php'; 
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Subscription List</h1>
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
          List of Subscription
        </h3>
      </div>
      <div class="card-body">
        
        <table id="subscriptionTable" class="table table-bordered table-hover text-nowrap table-sm">
          <thead>
            <tr>
              <th class="table-plus datatable-nosort" >No</th>
              <th>Client Name</th>
              <th>Coach Name</th>
              <th>Membership Name</th>
              <th>Membership Cost</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

            <?php

              // $subscriptions = $pdo->prepare("SELECT * FROM subscriptions");
              // $subscriptions->execute();
              $subscriptions = $connection->query("SELECT * FROM subscriptions");
              $number = 1;
              while($subscriptionsData = $subscriptions->fetch_array()){

                $coach = $connection->query("SELECT * FROM coach WHERE id = '".$subscriptionsData['coach_id']."'");
                $coachData = $coach->fetch_array();

                $membership = $connection->query("SELECT * FROM membership_plans WHERE id = '".$subscriptionsData['membership_id']."'");
                $membershipData = $membership->fetch_array();

                $client = $connection->query("SELECT * FROM client WHERE client_id = '".$subscriptionsData['client_id']."'");
                $clientData = $client->fetch_array();

                if ($subscriptionsData['coach_id'] == "") {
                  $fullname = "No Coach";
                }else{
                  $fullname = $coachData['firstname']." ".$coachData['middlename']." ".$coachData['lastname'];
                }
                $clientName = $clientData['firstname']." ".$clientData['middlename']." ".$clientData['lastname'];
            ?>
            <tr>
              <td> <?= $number++; ?> </td>
              <td> <?= $clientName; ?> </td>
              <td> <?= $fullname; ?> </td>
              <td> <?= $membershipData['membership_name']; ?> </td>
              <td> ₱<?= $subscriptionsData['membership_cost']; ?>.00 </td>
              <td>
                <!-- Renew -->
                <!-- <button type="button" class="btn btn-outline-success btn-xs renewSubscription" data-tooltip="tooltip" title="Click to Renew" data-id="<?php //echo $subscriptionsData['id']; ?>"><i class="fas fa-sync-alt"></i></button> -->
                <!-- View -->
                <button type="button" class="btn btn-outline-primary btn-xs viewSubscription" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $subscriptionsData['id']; ?>"><i class="fas fa-eye"></i></button>
                <!-- Delete -->
                <!-- <button type="button" class="btn btn-outline-danger btn-xs"><i class="fas fa-trash-alt"></i></button> -->
              </td>
            </tr>

            <div class="modal fade" id="renewSubscription<?php echo $subscriptionsData['id']; ?>">
              <div class="modal-dialog modal-xs">
                <div class="modal-content">
                  <form action="" method="POST" enctype="multipart/form-data" id="renewSubscriptions">
                    <div class="modal-body">
                      <h6 style="text-align: center;">
                        Are you sure you want to renew this subscription?
                        
                      </h6>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="price" value="<?php echo $subscriptionsData['membership_cost']; ?>">
                      <input type="hidden" name="client_id" value="<?php echo $subscriptionsData['client_id']; ?>">
                      <input type="hidden" name="coach_id" value="<?php echo $subscriptionsData['coach_id']; ?>">
                      <input type="hidden" name="end_date" value="<?php echo $subscriptionsData['end_date']; ?>">
                      <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary btn-xs">Yes</button>
                    </div>
                  </div><!-- /.modal-content -->
                </form>
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div class="modal fade" id="viewSubscription<?php echo $subscriptionsData['id']; ?>">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">
                      <i class="fas fa-info-circle"></i> Subscription's Information
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
                              <i class="fas fa-info-circle"></i> Coach Info
                            </h4>
                          </div>
                          <div class="card-body box-profile">
                            <div class="form-group">
                              <div class="text-center">
                                <?php  

                                  if ($subscriptionsData['coach_id'] == "") {
                                    ?>
                                      <h3 class="profile-username text-center" style="font-size: 20px;">No Coach</h3>
                                    <?php
                                  }else{
                                    if ($coachData['picture'] == "none" || $coachData['picture'] == NULL) {
                                      ?>
                                        <img src="/images/no_image.png" class="profile-user-img img-fluid img-circle">
                                      <?php
                                    }else {
                                      ?>
                                        <img src="/images/coach/<?php echo $coachData['picture']; ?>" class="profile-user-img img-fluid img-circle">

                                        <h3 class="profile-username text-center" style="font-size: 20px;"><?php echo $coachData['firstname']." ".$coachData['middlename']." ".$coachData['lastname']; ?></h3>

                                      <?php
                                    }
                                  }
                                  
                                ?>
                              </div>
                            </div>
                          </div>
                        </div><!-- /.card-body -->
                      </div><!-- /.col -->

                      <div class="col-lg-8">
                        <div class="card card-warning card-outline">
                          <div class="card-header">
                            <h4 class="card-title">
                              <i class="fas fa-info-circle"></i> Client Info
                            </h4>
                          </div>
                          <div class="card-body">
                            
                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                <i class="fas fa-user-circle text-sm"></i> <b>Client Name</b>
                                  <a class="float-right">
                                    <?= $clientName; ?>
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-dumbbell text-sm"></i> <b>Membership Name</b>
                                  <a class="float-right">
                                    <?= $membershipData['membership_name']; ?>
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-money-bill text-sm"></i> <b>Membership Cost</b>
                                  <a class="float-right">
                                    ₱<?= $subscriptionsData['membership_cost']; ?>.00
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-calendar-alt text-sm"></i> <b>Registration Date</b>
                                  <a class="float-right">
                                    <?= date('M d, Y', strtotime($subscriptionsData['registration_date'])); ?>
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-calendar-alt text-sm"></i> <b>Start Date</b>
                                  <a class="float-right">
                                    <?= date('M d, Y', strtotime($subscriptionsData['start_date'])); ?>
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-calendar-alt text-sm"></i> <b>End Date</b>
                                  <a class="float-right">
                                    <?= date('M d, Y', strtotime($subscriptionsData['end_date'])); ?>
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
  </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $('#subscriptionTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $(document).on('click', '.viewSubscription', function(){
      var id = $(this).attr('data-id');
      $('#viewSubscription'+id).modal('show');
    });

    $(document).on('click', '.renewSubscription', function(){
      var id = $(this).attr('data-id');
      $('#renewSubscription'+id).modal('show');
    });

    $('#renewSubscriptions').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "/includes/renew-subscription.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Contact Taken") {
            swal({
              title: "Contact Number already exist.",
              icon: "warning"
            });

          }else {
            swal({
              title: "Subscription has been Renew Successfully.",
              icon: "success"
            }).then(function(){
              location.reload();
            });
          }
        }
      })
    });

  });
</script>