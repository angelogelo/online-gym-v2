<?php 
  $page = 'client';
  include 'header.php'; 
?>


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Client Management</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Client Management</li>
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
      <?php 
        $subs = $connection->query("SELECT * FROM subscriptions WHERE coach_id = '".$coach_data['coach_id']."'");
        while($subs_data = $subs->fetch_array()){
          
          $client = $connection->query("SELECT * FROM client WHERE client_id = '".$subs_data['client_id']."'");
          $client_data = $client->fetch_array();
      ?>
      <div class="col-lg-4">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-warning">
            <h3 class="widget-user-username"><?= $client_data['firstname']." ".$client_data['middlename']." ".$client_data['lastname']; ?></h3>
            <h5 class="widget-user-desc"></h5>
          </div>
          <div class="widget-user-image">
            <?php  
              if ($client_data['picture'] == "none" || $client_data['picture'] == NULL) {
                ?>
                  <img src="/images/no_image.png" class="img-circle elevation-2">
                <?php
              }else {
                ?>
                  <img src="/images/client/<?php echo $client_data['picture']; ?>" class="img-circle elevation-2">
                <?php
              }
            ?>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header"><b>Status</b></h5>
                  <span>
                    <?php  
                      if ($client_data['status'] == "active") {
                        ?>
                          <span class="text-success">Active</span>
                        <?php
                      }else {
                        ?>
                          <span class="text-warning">Deactivated</span>
                        <?php
                      }
                    ?>
                  </span>
                </div><!-- /.description-block -->
              </div><!-- /.col -->
              
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header"><b>Start Date</b></h5>
                  <span class="description-text"><b><?= date('M d, Y', strtotime($subs_data['start_date'])); ?></b></span>
                </div><!-- /.description-block -->
              </div><!-- /.col -->

              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header"><b>View</b></h5>
                  
                  <a href="/view-client/<?= urlencode(base64_encode($client_data['client_id'])); ?>" class="viewClient" data-tooltip="tooltip" title="Click to View">
                    <i class="fas fa-eye text-primary"></i>
                  </a>
                </div><!-- /.description-block -->
              </div>
            </div><!-- /.row -->
          </div>
        </div>
      </div><!-- /.col -->
      <?php } ?>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content -->


<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $('#clientTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    //calculate BMI
    $("#height, #weight").keyup(function(){
      var totalBMI = 0;
      var finalTotal = 0;
      var height = Number($("#height").val());
      var weight = Number($("#weight").val());
      var totalBMI = weight/(height/100*height/100);
      var finalTotal = totalBMI.toFixed(1);
      $('#result').val(finalTotal);
    });

    $('#addRecommendationForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "../includes/addRecommendations.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Taken") {
            swal({
              title: "Failed to add new recommendations.",
              icon: "error"
            });

          }else {
            swal({
              title: "New recommendations has been added.",
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