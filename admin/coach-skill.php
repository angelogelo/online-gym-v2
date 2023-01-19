<?php

	$page = 'coach-skills';
	include 'header.php';

?>

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1	h1 class="m-0">Add Coach Skills</h1>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div><!-- /.content-header -->

<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<div class="row">

			<div class="col-lg-4">
				<div class="card card-warning card-outline">
					<form action="" method="POST" enctype="multipart/form-data" id="addSkillsForm">
						<div class="card-header">
							<h4 class="card-title">Coach Skills Form</h4>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label>Coach Skills</label>
								<input type="text" class="form-control form-control-sm" name="skills_name" placeholder="Enter Coach Skills" required>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-sm btn-outline-success"><i class="fas fa-save"></i> Save</button>
						</div>
					</form>
				</div>
			</div>

			<div class="col-lg-8">
				<div class="card card-warning card-outline">
					<div class="card-header">
						<h4 class="card-title">
							<i class="fas fa-chart-bar mr-1"></i>
							Coach Skills List
						</h4>
					</div>
					<div class="card-body">
						<table id="skillsTable" class="table table-bordered table-hover text-nowrap table-sm">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort" >No</th>
									<th>Skills Name</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php

									$skills = $connection->query("SELECT * FROM skills");
									$number = 1;
									while($skillsData = $skills->fetch_array()){

								?>
								<tr>
									<td> <?= $number++; ?> </td>
									<td> <?= $skillsData['skills_name'];?> </td>
									<td> 
									<!-- Edit -->
									<button type="button" class="btn btn-outline-primary btn-xs" data-toggle="modal" data-target="#editSkill<?php echo $skillsData['id']; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Click to Edit"></i></button>
									</td>
								</tr>

								<div class="modal fade" id="editSkill<?php echo $skillsData['id']; ?>">
									<div class="modal-dialog modal-md">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">
													<i class="fas fa-info-circle"></i> Skill Information
												</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="" method="POST" class="editSkillForm" id="editSkillForm<?php echo $skillsData['id']; ?>" data-id="<?php echo $skillsData['id']; ?>" enctype="multipart/form-data">
												<div class="modal-body">
													<div class="form-group">
														<label>Coach SKills</label>
														<input type="text" class="form-control form-control-sm" name="skills_name" placeholder="Enter Coach Skills" value="<?=$skillsData['skills_name'];?>" required>
													</div>
												</div><!--modal-body-->
												<div class="modal-footer justify-content-between">
													<input type="hidden" name="update_id" value="<?=$skillsData['id'];?>">
													<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
													<button type="submit" name="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-save"></i> | Update</button>
												</div>
											</form>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->

								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $('#skillsTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });


    $('#addSkillsForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "../includes/coach-skill.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Taken") {
            swal({
              title: "Coach Skill already exist.",
              icon: "warning"
            });

          }else {
            swal({
              title: "New coach skills has been added.",
              icon: "success"
            }).then(function(){
              location.reload();
            });
          }
        }
      })
    });

    $(document).on('submit', '.editSkillForm', function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var formData = new FormData($('#editSkillForm'+id)[0]);

      $.ajax({
        url: "/includes/coach-skill-edit.php",
        method: "POST",
        dataType: "TEXT",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          console.log(data);
          if (data == "Failed") {
            swal({
              title: "Failed to update skill information. Please try again later.",
              icon: "error"
            });

          }else {
            swal({
              title: "Skill has been successfully updated.",
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
