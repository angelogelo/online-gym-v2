<?php 
  $page = 'health';
  include 'header.php' 
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Health</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Health</li>
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
        <form action="" method="POST" enctype="multipart/form-data" id="addBmiForm">
          <div class="card card-warning card-outline">
            <div class="card-header">
              <h4 class="card-title">Body Mass Index Form</h4>
            </div>
            <div class="card-body">

              <div class="form-group">
                <span><b>Height</b></span>
                <input type="number" class="form-control form-control-sm" id="height" placeholder="CM" name="height" required>
              </div>
              <div class="form-group">
                <span><b>Weight</b></span>
                <input type="number" class="form-control form-control-sm" id="weight" placeholder="KG" name="weight" required>
              </div>

              <div class="form-group">
                <span><b>Date</b></span>
                <input type="date" class="form-control form-control-sm" name="created_at" min="<?= $dateNow; ?>" required>
              </div>
              <div class="form-group">
                <span><b>Body Mass Index (BMI)</b></span><br>
                <output id="result"></output>
              </div>

            </div><!-- /.card-body -->
            <div class="card-footer">
              <input type="hidden" name="client_id" value="<?= $username; ?>">
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
              Body Mass Index List <?= $username; ?>
            </h4>
          </div>
          <div class="card-body">
            <table id="clientBmiTable" class="table table-bordered table-hover text-nowrap table-sm">
              <thead>
              <tr>
                <th class="table-plus datatable-nosort" >No</th>
                <th>Weight</th>
                <th>Height</th>
                <th>BMI</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php

                  $client_bmi = $connection->query("SELECT * FROM client_bmi WHERE client_id = '".$username."' ORDER BY created_at DESC");
                  $number = 1;
                  while($client_bmi_data = $client_bmi->fetch_array()){
                  
                ?>
                <tr>
                  <td> <?= $number++; ?> </td>
                  <td> <?= $client_bmi_data['height']; ?> </td>
                  <td> <?= $client_bmi_data['weight']; ?> </td>
                  <td> <?= $client_bmi_data['bmi']; ?> </td>
                  <td> <?= date('M d, Y', strtotime($client_bmi_data['created_at'])); ?> </td>
                  <td>
                    <!-- View -->
                    <button class="btn btn-outline-warning btn-xs viewComment" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $client_bmi_data['id']; ?>"><i class="far fa-comment"></i></button>
                  </td>
                </tr>

                <div class="modal fade" id="viewComment<?php echo $client_bmi_data['id']; ?>">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">
                          <i class="fas fa-dumbbell"></i> Workout and Diet Recommendations
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      </div><!-- /.modal-body -->
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <div class="modal fade" id="insertComment<?php echo $client_bmi_data['id']; ?>">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <form action="" method="POST" enctype="multipart/form-data" id="addInsertComment">
                        <div class="modal-header">
                          <h4 class="modal-title">
                            <i class="fas fa-dumbbell"></i> Workout and Diet Recommendations
                          </h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <textarea name="actionTaken" id="summernote" class="textarea" placeholder="Place some text here" required
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                          </div>
                        </div><!-- /.modal-body -->
                        <div class="card-footer">
                          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
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
    </div><!-- ./row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php' ?>

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click', '.viewComment', function(){
      var id = $(this).attr('data-id');
      $('#viewComment'+id).modal('show');
    });

    $(document).on('click', '.insertComment', function(){
      var id = $(this).attr('data-id');
      $('#insertComment'+id).modal('show');
    });

    $('#clientBmiTable').DataTable({
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

    $('#addSubscriptionForm').submit(function(e){
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

    $('#addBmiForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "../includes/client-add-bmi.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Failed") {
            swal({
              title: "Failed to add new BMI.",
              icon: "error"
            });

          }else {
            swal({
              title: "New Body Mass Index has been added.",
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