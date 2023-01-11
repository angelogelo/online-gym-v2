<?php include 'header.php'; ?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Membership Plans</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Add Membership Plans</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4">
        <form action="" method="POST" enctype="multipart/form-data" id="addSubscriptionForm">
          <div class="card card-warning card-outline">
            <div class="card-header">
              <h4 class="card-title">Membership Plan Form</h4>
            </div>
            <div class="card-body">

              <div class="form-group">
                <span><b>Membership Name</b></span>
                <input type="text" class="form-control form-control-sm" name="membership_name" placeholder="Enter Membership Name" required>
              </div>

              <div class="form-group">
                <span><b>Price</b></span>
                <input type="text" class="form-control form-control-sm" name="price" placeholder="Enter Price" required>
              </div>

              <div class="form-group">
                <span><b>Duration</b></span>
                <select name="duration" class="form-control form-control-sm" required>
                  <option selected="" disabled="" value="">- - - Select Duration - - -</option>
                  <option value="1 Day">1 Day</option>
                  <option value="1 Month">1 Month</option>
                  <option value="2 Months">2 Months</option>
                  <option value="3 Months">3 Months</option>
                  <option value="4 Months">4 Months</option>
                  <option value="5 Months">5 Months</option>
                  <option value="6 Months">6 Months</option>
                  <option value="7 Months">7 Months</option>
                  <option value="8 Months">8 Months</option>
                  <option value="9 Months">9 Months</option>
                  <option value="10 Months">10 Months</option>
                  <option value="111 Months">11 Months</option>
                  <option value="1 Year">1 Year</option>
                </select>
              </div>

              <div class="form-group">
                <span><b>Details</b></span>
                <input type="text" class="form-control form-control-sm" name="details" placeholder="Enter Details" required>
              </div>

            </div><!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            </div>
          </div><!-- /.card -->
        </form>
      </div><!-- /.col -->

      <div class="col-lg-8">
        <div class="card card-warning card-outline">
          <div class="card-header">
            <h4 class="card-title">
              <i class="fas fa-chart-bar mr-1"></i>
              Membership Plans List
            </h4>
          </div>
          <div class="card-body">
            <table id="membersTable" class="table table-bordered table-hover text-nowrap table-sm">
              <thead>
              <tr>
                <th class="table-plus datatable-nosort" >No</th>
                <th>Membership Name</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Date Added</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php

                  $membershipPlan = $connection->query("SELECT * FROM membership_plans");
                  $number = 1;
                  while($membershipPlanRow = $membershipPlan->fetch_array()){
                  
                ?>
                <tr>
                  <td> <?= $number++; ?> </td>
                  <td> <?= $membershipPlanRow['membership_name']; ?> </td>
                  <td> <?= $membershipPlanRow['price']; ?> </td>
                  <td> <?= $membershipPlanRow['duration']; ?> </td>
                  <td> <?= date('M d, Y', strtotime($membershipPlanRow['created_at'])); ?> </td>
                  <td>

                    <!-- Check -->
                    <button class="btn btn-warning btn-sm checkAvail" data-tooltip="tooltip" title="Click to See Who Has Avail" data-id="<?php echo urlencode(base64_encode($membershipPlanRow['id'])); ?>"><i class="fas fa-check"></i></button>

                    <!-- View -->
                    <button class="btn btn-primary btn-sm viewMembership" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $membershipPlanRow['id']; ?>"><i class="fas fa-eye"></i></button>

                    <!-- Edit -->
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editMembership<?php echo $membershipPlanRow['id']; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Click to Edit"></i></button>

                    <!-- Delete -->
                    <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>

                  </td>
                </tr>

                  <div class="modal fade" id="viewMembership<?php echo $membershipPlanRow['id']; ?>">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">
                            <i class="fas fa-info-circle"></i>Membership Plan's Information
                          </h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                              <b>Membership Name</b>
                                <a class="float-right">
                                  <?= $membershipPlanRow['membership_name']; ?>
                                </a>
                            </li>
                            <li class="list-group-item">
                              <b>Membership Price</b>
                                <a class="float-right">
                                  <?= $membershipPlanRow['price']; ?>
                                </a>
                            </li>
                            <li class="list-group-item">
                              <b>Membership Duration</b>
                                <a class="float-right">
                                  <?= $membershipPlanRow['duration']; ?>
                                </a>
                            </li>
                            <li class="list-group-item">
                              <b>Membership Created</b>
                                <a class="float-right">
                                  <?= date('M d, Y', strtotime($membershipPlanRow['created_at'])); ?>
                                </a>
                            </li>
                          </ul>
                        </div><!-- /.modal-body -->
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->

                  <div class="modal fade" id="editMembership<?php echo $membershipPlanRow['id']; ?>">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">
                            <i class="fas fa-info-circle"></i> Update Membership Plan's Information
                          </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form action="" method="POST" class="editMembershipForm" id="editMembershipForm<?php echo $membershipPlanRow['id']; ?>" data-id="<?php echo $membershipPlanRow['id']; ?>" enctype="multipart/form-data">
                        <div class="modal-body">

                          <div class="form-group">
                            <span><b>Membership Name</b></span>
                            <input type="text" class="form-control form-control-sm" name="membership_name" value="<?php echo $membershipPlanRow['membership_name']; ?>" required>
                          </div>

                          <div class="form-group">
                            <span><b>Price</b></span>
                            <input type="text" class="form-control form-control-sm" name="price" value="<?php echo $membershipPlanRow['price']; ?>" required>
                          </div>

                          <div class="form-group">
                            <span><b>Duration</b></span>
                            <select name="duration" class="form-control form-control-sm" required>
                              <option selected="" value="<?php echo $membershipPlanRow['duration']; ?>"><?php echo $membershipPlanRow['duration']; ?> - Current</option>
                              <option value="1 Day">1 Day</option>
                              <option value="1 Month">1 Month</option>
                              <option value="2 Months">2 Months</option>
                              <option value="3 Months">3 Months</option>
                              <option value="4 Months">4 Months</option>
                              <option value="5 Months">5 Months</option>
                              <option value="6 Months">6 Months</option>
                              <option value="7 Months">7 Months</option>
                              <option value="8 Months">8 Months</option>
                              <option value="9 Months">9 Months</option>
                              <option value="10 Months">10 Months</option>
                              <option value="111 Months">11 Months</option>
                              <option value="1 Year">1 Year</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <span><b>Details</b></span>
                            <input type="text" class="form-control form-control-sm" name="details" value="<?php echo $membershipPlanRow['details']; ?>" required>
                          </div>

                        </div><!--modal-body-->
                        <div class="modal-footer justify-content-between">
                          <input type="hidden" name="update_id" value="<?=$membershipPlanRow['id'];?>">
                          <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save"></i> | Update</button>
                        </div>
                        </form>
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->

                <?php } ?>
              </tbody>
            </table>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /.col -->

    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content -->
<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $('#membersTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

   $(document).on('click', '.checkAvail', function(){
      var id = $(this).attr('data-id');
      window.location.href = 'checkAvail.php?id='+id;
    });


    $(document).on('click', '.viewMembership', function(){
      var id = $(this).attr('data-id');
      $('#viewMembership'+id).modal('show');
    });


    // $("#plan").keyup(function(){
    //   var price = 0;
    //   var plan = Number($("#plan").val());

    //   var price = plan*300;
    //   var total = price + '.00';

    //   $('#price').val(total);
    // });


    $('#addSubscriptionForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "../includes/addMembership.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Taken") {
            swal({
              title: "Failed to add new membership plan. Plan Already Exist.",
              icon: "error"
            });

          }else {
            swal({
              title: "New membership plan has been added.",
              icon: "success"
            }).then(function(){
              location.reload();
            });
          }
        }
      })
    });

    $(document).on('submit', '.editMembershipForm', function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var formData = new FormData($('#editMembershipForm'+id)[0]);

      $.ajax({
        url: "../includes/updateMembership.php",
        method: "POST",
        dataType: "TEXT",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          console.log(data);
          if (data == "Nothing to Update") {
            swal({
              title: "No information to be updated.",
              icon: "warning"
            });
          }else if (data == "Failed") {
            swal({
              title: "Failed to add edit College. Please try again later.",
              icon: "error"
            });
          }else {
            swal({
              title: "Membership Plan has updated.",
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