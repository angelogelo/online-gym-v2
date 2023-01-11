<?php
  $page = 'client-add';
  include 'header.php'; 
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add Client</h1>
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
        <form action="" method="POST" enctype="multipart/form-data" id="addMemberForm">
          <div class="card card-warning card-outline">
            <div class="card-body box-profile">
              
              <div class="text-center">
                <img id="picture_display" class="profile-user-img img-fluid img-circle" src="../images/no_image.png" style="width: 200px; display: block; margin-right: auto; margin-left: auto;">
              </div>
              <br>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <label>Upload Picture</label>
                  <div class="custom-file">
                    <input type="file" name="picture" id="picture" class="custom-file-input form-control-sm" accept="image/*" required>
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
            </div>
            <div class="card-body">

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <span><b>First Name</b></span>
                    <input type="text" class="form-control form-control-sm" name="firstname" placeholder="Enter First Name" required>
                  </div>
                  <div class="form-group">
                    <span><b>Middle Name</b></span>
                    <input type="text" class="form-control form-control-sm" name="middlename" placeholder="Enter Middle Name" required>
                  </div>
                  <div class="form-group">
                    <span><b>Last Name</b></span>
                    <input type="text" class="form-control form-control-sm" name="lastname" placeholder="Enter Last Name" required>
                  </div>
                  <div class="form-group">
                    <span><b>Phone Number</b></span>
                    <input type="text" class="form-control form-control-sm" name="contact_no" placeholder="Enter Contact Number" required>
                  </div>
                  <div class="form-group">
                    <span><b>Gender</b></span><br>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" name="gender" id="gendermale" class="custom-control-input" value="Male" required>
                      <label class="custom-control-label" for="gendermale">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" name="gender" id="genderfemale" class="custom-control-input" value="Female" required>
                      <label class="custom-control-label" for="genderfemale">Female</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <span><b>Body Mass Index (BMI)</b></span><br>
                    <output class="text-bold" id="result"><b></b></output>
                  </div>
                </div><!-- /.col -->

                <div class="col-lg-6">
                  <div class="form-group">
                    <span><b>Birth Date</b></span>
                    <input type="date" class="form-control form-control-sm" name="birthDate" required>
                  </div>
                  
                  <div class="form-group">
                    <span><b>Height</b></span>
                    <input type="number" class="form-control form-control-sm" id="height" placeholder="CM" name="height" required>
                  </div>
                  <div class="form-group">
                    <span><b>Weight</b></span>
                    <input type="number" class="form-control form-control-sm" id="weight" placeholder="KG" name="weight" required>
                  </div>
                  <div class="form-group">
                    <span><b>Address</b></span>
                    <textarea class="form-control" rows="4" name="address" placeholder="Address...."></textarea>
                  </div>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-save"></i> Save</button>
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

    $('#addMemberForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "/includes/client-add.php",
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

          }else if (data == "Insert Failed") {
            swal({
              title: "Failed to add new member. Please try again later.",
              icon: "error"
            });

          }else if (data == "Image failed") {
            swal({
              title: "Failed to upload image. Please try another one.",
              icon: "error"
            });

          }else {
            swal({
              title: "New member has been added.",
              icon: "success"
            }).then(function(){
              location.href = "client-list.php";
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