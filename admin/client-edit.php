<?php 
  $page = 'client-edit';
  include 'header.php'; 

  $client_id = $_GET['id'];
  //$client_id = urldecode(base64_decode($id));

  // $client = $pdo->prepare("SELECT * FROM client WHERE id = '".$client_id."'");
  // $client->execute();
  // $clientData = $client->fetch(PDO::FETCH_ASSOC);

  $client = $connection->query("SELECT * FROM client WHERE id = '".$client_id."'");
  $clientData = $client->fetch_array();

  $birthDate = new DateTime($clientData['birthDate']);
  $age = $birthDate->diff(new DateTime);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Client</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      
        <div class="col-lg-4 col-md-4">
          <div class="card card-warning card-outline">
            <div class="card-body box-profile">
              <form action="" method="POST" enctype="multipart/form-data" id="updateClientForm">
              <div class="text-center">
                <?php
                  if ($clientData['picture'] == "none" || $clientData['picture'] == NULL) {
                    $updatePictureDisplay = "no_image.png";
                  }else {
                    $updatePictureDisplay = $clientData['picture'];
                  }
                ?>
                <img id="picture_display" class="img-fluid rounded" src="/images/client/<?php echo $updatePictureDisplay; ?>" style="width: 200px; display: block; margin-right: auto; margin-left: auto;">
              </div>
              <br>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <label>Upload Picture</label>
                  <div class="custom-file">
                    <input type="file" name="picture" id="picture" class="custom-file-input form-control-sm" accept="image/*">
                    <label class="custom-file-label">Choose file</label>
                  </div>
                </li>
              </ul>
            </div>
          </div><!-- /.card-body -->
        </div><!-- /.col -->

        <div class="col-lg-8">
          <div class="card card-warning card-outline">
            <div class="card-header">
              <h4 class="card-title">Client Form</h4>

              <div class="card-tools">
                <span>Client ID - <?= $clientData['client_id']; ?></span>
              </div>
            </div>
            <div class="card-body">

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <span><b>First Name</b></span>
                    <input type="text" class="form-control form-control-sm" name="firstname" value="<?= $clientData['firstname']; ?>">
                  </div>
                  <div class="form-group">
                    <span><b>Middle Name</b></span>
                    <input type="text" class="form-control form-control-sm" name="middlename" value="<?= $clientData['middlename']; ?>">
                  </div>
                  <div class="form-group">
                    <span><b>Last Name</b></span>
                    <input type="text" class="form-control form-control-sm" name="lastname" value="<?= $clientData['lastname']; ?>">
                  </div>
                  <div class="form-group">
                    <span><b>Phone Number</b></span>
                    <input type="text" class="form-control form-control-sm" name="contact_no" value="<?= $clientData['contact_no']; ?>">
                  </div>
                  <div class="form-group">
                    <span><b>Gender</b></span><br>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" name="gender" id="gendermale" class="custom-control-input" value="Male" <?php echo ($clientData['gender'] == 'Male') ? 'checked' : null; ?> required>
                      <label class="custom-control-label" for="gendermale">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" name="gender" id="genderfemale" class="custom-control-input" value="Female" <?php echo ($clientData['gender'] == 'Female') ? 'checked' : null; ?> required>
                      <label class="custom-control-label" for="genderfemale">Female</label>
                    </div>
                  </div>
                </div><!-- /.col -->

                <div class="col-lg-6">
                  <div class="form-group">
                    <span><b>Birth Date</b></span>
                    <input type="date" class="form-control form-control-sm" name="birthDate" value="<?= $clientData['birthDate']; ?>">
                  </div>
                  <div class="form-group">
                    <span><b>Address</b></span>
                    <textarea class="form-control" rows="4" name="address"><?= $clientData['address']; ?></textarea>
                  </div>
                </div><!-- /.col -->

                <div class="col-2">
                  <div class="form-group">
                    <input type="hidden" name="update_id" id="update_id" value="<?= $clientData['id']; ?>">
                    <button type="submit" class="btn btn-success btn-sm btn-block"><i class="fas fa-save"></i> Update</button>
                  </div>
                </div><!-- /.col -->

              </div><!-- /.row -->
              </form>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content -->
<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $('#updateClientForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "/includes/client-edit.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Failed") {
            swal({
              title: "Failed to update client's information. Please try again later.",
              icon: "error"
            });

          }else {
            swal({
              title: "Client's information has been updated.",
              icon: "success"
            }).then(function(){
              //location.href = "/list-client";
              location.reload();
            });
          }
        }
      })
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

  });
</script>