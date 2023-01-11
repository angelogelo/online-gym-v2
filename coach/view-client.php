<?php
    $page = 'client';
    include 'header.php';

    $client_id = $_GET['id'];
    //$client_id = urldecode(base64_decode($id));

    $client = $connection->query("SELECT * FROM client WHERE client_id = '".$client_id."'");
    $client_data = $client->fetch_array();

    $birthDate = new DateTime($client_data['birthDate']);
    $age = $birthDate->diff(new DateTime);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><?= $client_data['firstname'].' '.$client_data['lastname']; ?></h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-4 col-md-4">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Personal Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <?php  
                                    if ($client_data['picture'] == "none" || $client_data['picture'] == NULL) {
                                        ?>
                                        <img class="profile-user-img img-fluid img-circle" src="/images/no_image.png" style="width: 200px; display: block; margin-right: auto; margin-left: auto;">
                                    <?php
                                    }else {
                                        ?>
                                        <img class="profile-user-img img-fluid img-circle" src="/images/client/<?= $client_data['picture']; ?>" style="width: 200px; display: block; margin-right: auto; margin-left: auto;">
                                    <?php
                                    }
                                ?>
                            </div><br>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <i class="fas fa-venus-mars text-sm"></i> <b>Gender</b>
                                    <a class="float-right"><?= $client_data['gender']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-calendar-alt text-sm"></i> <b>Birthdate</b>
                                    <a class="float-right"><?= date('M d, Y', strtotime($client_data['birthDate'])); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-calendar-minus text-sm"></i> <b>Age</b>
                                    <a class="float-right"><?= $age->y; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-phone-alt text-sm"></i> <b>Contact No</b>
                                    <a class="float-right"><?= $client_data['contact_no']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-map-marked-alt text-sm"></i> <b>Address</b>
                                    <a class="float-right"><?= $client_data['address']; ?></a>
                                </li>
                            </ul>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
                
                <div class="col-lg-8">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Client BMI Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="clientsTable" class="table table-bordered table-hover text-nowrap table-sm">
                                    <thead>
                                        <tr>
                                            <th>Weight</th>
                                            <th>Height</th>
                                            <th>BMI</th>
                                            <th>Date</th>
                                            <th style="width:10px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $client_bmi = $connection->query("SELECT * FROM client_bmi WHERE client_id = '".$client_id."' ORDER BY created_at DESC");
                                            $number = 1;
                                            while($client_bmi_data = $client_bmi->fetch_array()){

                                        ?>
                                        <tr>
                                            <td> <?= $client_bmi_data['height']; ?> </td>
                                            <td> <?= $client_bmi_data['weight']; ?> </td>
                                            <td> <?= $client_bmi_data['bmi']; ?> </td>
                                            <td> <?= date('M d, Y', strtotime($client_bmi_data['created_at'])); ?> </td>
                                            <td>
                                                <!-- Recommendations -->
                                                <button class="btn btn-outline-warning btn-xs commentRecommendations" title="Click to Add Reccomendation" data-id="<?php echo $client_bmi_data['id']; ?>"><i class="far fa-comment"></i></button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="commentRecommendations<?php echo $client_bmi_data['id']; ?>">
                                            <div class="modal-dialog modal-md">
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
                                                        <textarea name="comment_recommendation" id="summernote" class="textarea" placeholder="Place some text here" required
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
                            </div><!-- /.row -->
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->   
<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click', '.commentRecommendations', function(){
      var id = $(this).attr('data-id');
      $('#commentRecommendations'+id).modal('show');
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

    $(document).on('submit', '.commentRecommendations', function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var formData = new FormData($('#commentRecommendations'+id)[0]);

      $.ajax({
        url: "../includes/commentRecommendations.php",
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