<?php 
  $page = 'subscription-add';
  include 'header.php'; 
?>

<!-- <style>
  .coach-box{
    display: none;
  }
</style> -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Subscription</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8">
        <form action="" method="POST" enctype="multipart/form-data" id="addSubscriptionForm">
          <div class="card card-warning card-outline">
            <div class="card-header">
              <h4 class="card-title">Subscription Form</h4>
            </div>
            <div class="card-body">
              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <span><b>Client</b></span>
                    <select name="client_id" class="form-control form-control-sm" required>
                      <option selected="" disabled="" value="">- - - Select Client - - -</option>
                      <?php  
                        $client = $connection->query("SELECT * FROM client");
                        if ($client->num_rows < 1) {
                          ?>
                            <option disabled>No client available</option>
                          <?php
                        }else {
                          while ($clientData = $client->fetch_array()) {
                            ?>
                              <option value="<?= $clientData['client_id']; ?>">
                                <?= $clientData['firstname']." ".$clientData['middlename']." ".$clientData['lastname']; ?>
                              </option>
                            <?php
                          }
                        }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <span><b>Membership Plans</b></span>
                    <select name="membership_id" id="selectdata" class="form-control form-control-sm" onchange="changeDropdown(this.value);" required>
                      <option selected="" disabled="" value="">- - - Select Membership Plans - - -</option>
                      <?php
                        $membership = $connection->query("SELECT * FROM membership_plans");
                        if ($membership->num_rows < 1) {
                          ?>
                            <option disabled>No membership available</option>
                          <?php
                        }else {
                          while ($membershipRow = $membership->fetch_array()) {
                            ?>
                              <option value="<?php echo $membershipRow['id']; ?>" data-price="<?php echo $membershipRow['price']; ?>">

                              <?php echo $membershipRow['membership_name']; ?>
                                
                            </option>
                            <?php
                          }
                        }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <span><b>Price</b></span>
                    <input type="text" class="form-control form-control-sm" name="membership_cost" id="price" readonly>
                  </div>

                  <div class="form-group coach-box" id="coach_show">
                    <span><b>Coach</b></span>
                    <select name="coach_id" class="form-control form-control-sm">
                      <option selected="" value="">- - - Select Coach - - -</option>
                      <?php  
                        $coach = $connection->query("SELECT * FROM coach");
                        if ($coach->num_rows < 1) {
                          ?>
                            <option disabled>No coach available</option>
                          <?php
                        }else {
                          while ($coachData = $coach->fetch_array()) {
                            ?>
                              <option value="<?= $coachData['id']; ?>">

                              <?= $coachData['firstname']; ?>
                                
                            </option>
                            <?php
                          }
                        }
                      ?>
                    </select>
                  </div>

                </div><!-- /.col -->

                <div class="col-lg-6">

                  <div class="form-group">
                    <span><b>Registration Date</b></span>
                    <input type="date" class="form-control form-control-sm" name="registration_date" min="<?= $dateNow; ?>" required>
                  </div>

                  <div class="form-group">
                    <span><b>Start Date</b></span>
                    <input type="date" class="form-control form-control-sm" name="start_date" id="start" min="<?= $dateNow; ?>" onchange="selectDate();" required>
                  </div>

                  <div class="form-group">
                    <span><b>End Date</b></span>
                    <input type="date" class="form-control form-control-sm" name="end_date" id="end" min="" required>
                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="form-group">
                <span><b>Remarks</b></span>
                <textarea class="form-control" rows="4" name="remark" placeholder="Remarks...."></textarea>
              </div>

            </div><!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-outline-success"><i class="fas fa-save"></i> Save</button>
            </div>
          </div><!-- /.card -->
        </form>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content -->
<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){


    // $("#plan").keyup(function(){
    //   var price = 0;
    //   var plan = Number($("#plan").val());

    //   var price = plan*300;
    //   var total = price + '.00';

    //   $('#price').val(total);
    // });

    $('#price').val($('#selectdata option:selected').data('price'));
      $(function(){
          $('#selectdata').change(function(){
              $('#price').val($('#selectdata option:selected').data('price'));
          });
    });


    $('#addSubscriptionForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "../includes/subscription-add.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Failed") {
            swal({
              title: "Failed to add new subscription.",
              icon: "error"
            });

          }else if (data == "Taken") {
            swal({
              title: "Failed to add new client to the subscriptions. Client Already Exist.",
              icon: "info"
            });

          }else {
            swal({
              title: "New client subscription has been added.",
              icon: "success"
            }).then(function(){
              location.href = "subscription-list.php";
            });
          }
        }
      })
    });



  });
</script>

<script>
  
  function selectDate() {
    var start = document.getElementById("start").value;
    document.getElementById("end").value = "";
    document.getElementById("end").setAttribute("min",start);
  }

  document.getElementById("coach_show").style.visibility='hidden';

  function changeDropdown(){
    var state = document.getElementById("selectdata").value;
    if (state == "5") {
      document.getElementById("coach_show").style.visibility='visible';
    }else{
      document.getElementById("coach_show").style.visibility='hidden';
    }
  }

</script>

<!-- <script>
  
  $(function(){

      $('#membership_id').keyup(function() {
          var membership_id = $(this).val();
          alert(membership_id);
          var data_String = 'membership_id=' + membership_id;
          $.get('../includes/select.php', data_String, function(result) {
              $.each(result, function(){
                  $('#membership_id').val(this.membership_id);
                  $('#price').val(this.price);
          });
      });
    });

  });

</script> -->