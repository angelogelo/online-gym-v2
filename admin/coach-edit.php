<?php 
  $page = 'coach-edit';
  include 'header.php'; 

  $coach_id = $_GET['id'];
  //$coach_id = urldecode(base64_decode($id));

  $coach = $connection->query("SELECT * FROM coach WHERE id='$coach_id'");
  $coachData = $coach->fetch_array();

  $birthDate = new DateTime($coachData['birthDate']);
  $age = $birthDate->diff(new DateTime);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Coach</h1>
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
				<div class="card card-primary card-outline">
					<div class="card-body box-profile">
				<form action="" method="POST" enctype="multipart/form-data" id="updateCoachForm">
						<div class="text-center">
							<?php
								if ($coachData['picture'] == "none" || $coachData['picture'] == NULL) {
								$updatePictureDisplay = "no_image.png";
								}else {
								$updatePictureDisplay = $coachData['picture'];
								}
							?>
							<img id="picture_display" class="img-fluid rounded" src="/images/coach/<?php echo $updatePictureDisplay; ?>" style="width: 200px; display: block; margin-right: auto; margin-left: auto;">
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
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</div><!-- /.col -->

			<div class="col-lg-8">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h4 class="card-title">Coach Form</h4>

						<div class="card-tools">
							<span>Client ID - <?= $coachData['coach_id']; ?></span>
						</div>
					</div>
					<div class="card-body">

						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<span><b>First Name</b></span>
									<input type="text" class="form-control form-control-sm" name="firstname" value="<?= $coachData['firstname']; ?>">
								</div>
								<div class="form-group">
									<span><b>Middle Name</b></span>
									<input type="text" class="form-control form-control-sm" name="middlename" value="<?= $coachData['middlename']; ?>">
								</div>
								<div class="form-group">
									<span><b>Last Name</b></span>
									<input type="text" class="form-control form-control-sm" name="lastname" value="<?= $coachData['lastname']; ?>">
								</div>
								<div class="form-group">
									<span><b>Phone Number</b></span>
									<input type="text" class="form-control form-control-sm" name="contact_no" value="<?= $coachData['contact_no']; ?>">
								</div>
								<div class="form-group">
									<span><b>Gender</b></span><br>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" name="gender" id="gendermale" class="custom-control-input" value="Male" <?php echo ($coachData['gender'] == 'Male') ? 'checked' : null; ?> required>
										<label class="custom-control-label" for="gendermale">Male</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" name="gender" id="genderfemale" class="custom-control-input" value="Female" <?php echo ($coachData['gender'] == 'Female') ? 'checked' : null; ?> required>
										<label class="custom-control-label" for="genderfemale">Female</label>
									</div>
								</div>
							</div><!-- /.col -->

							<div class="col-lg-6">
								<div class="form-group">
									<span><b>Birth Date</b></span>
									<input type="date" class="form-control form-control-sm" name="birthDate" value="<?= $coachData['birthDate']; ?>">
								</div>
								<div class="form-group">
									<span><b>Skills</b></span>
									<select name="coach_skills" class="form-control form-control-sm" required>
									<option selected="" value="<?php echo $coachData['coach_skills_id']; ?>">- - - Select Coach Skills - - -</option>
									<?php  
										$skills = $connection->query("SELECT * FROM skills");
										if ($skills->num_rows < 1) {
									?>
										<option disabled>No skills available</option>
									<?php
										}else {
										while ($skillsData = $skills->fetch_array()) {
									?>
										<option value="<?php echo $skillsData['id']; ?>"><?php echo $skillsData['skills_name']; ?> <?php echo ($skillsData['id'] == $coachData['coach_skills_id']) ? '- Current' : null; ?></option>
									<?php
											}
										}
									?>
									</select>
								</div>
								<div class="form-group">
									<span><b>Address</b></span>
									<textarea class="form-control" rows="4" name="address"><?= $coachData['address']; ?></textarea>
								</div>
							</div><!-- /.col -->

						<div class="col-2">
							<div class="form-group">
								<input type="hidden" name="update_id" id="update_id" value="<?php echo $coachData['id']; ?>">
								<button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Update</button>
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

    $('#updateCoachForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "/includes/coach-edit.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Failed") {
            swal({
              title: "Failed to update coach's information. Please try again later.",
              icon: "error"
            });

          }else {
            swal({
              title: "Coach's information has been updated.",
              icon: "success"
            }).then(function(){
              //location.href = "/list-coach.php";
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