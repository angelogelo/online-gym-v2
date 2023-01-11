<?php

  $page = 'about-us';
  include 'header.php';
  
?>

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-12">
				<h1 class="m-0"><i class="nav-icon fas fa-info-circle"></i> About Us</h1>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<div class="row">

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="card card-primary card-outline">
					<div class="card-body">
						<table id="aboutUsTable" class="table table-bordered table-hover text-nowrap table-sm">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort" >No</th>
									<th>Gym Name</th>
									<th>Gym Address</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$aboutus = $connection->query("SELECT * FROM about");
									$number = 1;
									while($aboutusRow = $aboutus->fetch_array()){                           
								?>
								<tr>
									<td><?php echo $number++; ?></td>
									<td><?=$aboutusRow['gym_name'];?></td>
									<td><?=$aboutusRow['gym_address'];?></td>
								<td>
									<!-- View -->
									<button data-tooltip="tooltip" title="Click to View" class="btn btn-outline-success btn-xs viewAbout" data-toggle="tooltip" data-placement="top" data-id="<?php echo $aboutusRow['id']; ?>"><i class="fa fa-eye"></i></button>

									<!-- Edit -->
									<button type="button" class="btn btn-outline-primary btn-xs" data-toggle="modal" data-target="#editAboutUs<?php echo $aboutusRow['id']; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Click to Edit"></i></button>
								</td>
							</tr>

							<div class="modal fade" id="editAboutUs<?php echo $aboutusRow['id']; ?>">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">
												<i class="fas fa-info-circle"></i> About Us Information
											</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form action="" method="POST" class="editAboutUsForm" id="editAboutUsForm<?php echo $aboutusRow['id']; ?>" data-id="<?php echo $aboutusRow['id']; ?>" enctype="multipart/form-data">
											<div class="modal-body">

												<div class="form-group row">
													<div class="col-lg-12">
														<label>Gym Name</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text"><i class="fas fa-Gym"></i></span>
															</div>
															<input type="text" class="form-control form-control-sm" name="edit_gym_name" value="<?=$aboutusRow['gym_name'];?>" required>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-lg-12">
														<label>Gym Address</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
															</div>
															<textarea class="form-control form-control-sm" rows="1" name="edit_gym_address" required> <?=$aboutusRow['gym_address'];?> </textarea>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-lg-12">
														<label>Mission</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	<span class="input-group-text"><i class="fas fa-bullseye"></i></span>
																</div>
															<textarea class="form-control form-control-sm" rows="3" name="edit_mission" required> <?=$aboutusRow['mission'];?> </textarea>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-lg-12">
													<label>Vision</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	<span class="input-group-text"><i class="fas fa-eye"></i></span>
																</div>
															<textarea class="form-control form-control-sm" rows="3" name="edit_vision" required> <?=$aboutusRow['vision'];?> </textarea>
														</div>
													</div>
												</div>

											</div><!--modal-body-->
											<div class="modal-footer justify-content-between">
												<input type="hidden" name="update_id" value="<?=$aboutusRow['id'];?>">
												<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
												<button type="submit" name="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-save"></i> | Update</button>
											</div>
										</form>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->

							<div class="modal fade" id="viewAboutModal<?php echo $aboutusRow['id']; ?>">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">
												<i class="fas fa-info-circle"></i> About Us Information
											</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group row">
												<div class="col-md-12">
													<label class="col-form-label">Gym Name</label>
													<p class="h6"><?=$aboutusRow['gym_name'];?></p>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-md-12">
													<label class="col-form-label">Gym Address</label>
													<p class="h6"><?=$aboutusRow['gym_address'];?></p>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-md-12">
													<label class="col-form-label">Mission</label>
													<p class="h6"><?=$aboutusRow['mission'];?></p>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-md-12">
													<label class="col-form-label">Vision</label>
													<p class="h6"><?=$aboutusRow['vision'];?></p>
												</div>
											</div>
										</div><!--modal-body-->
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							<?php
							}
							?>
							</tbody>
						</table>
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</div><!-- /.column -->

		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php' ?>

<script type="text/javascript">
  $(document).ready(function(){

    $('#aboutUsTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $(document).on('click', '.viewAbout', function(){
      var id = $(this).attr('data-id');
      $('#viewAboutModal'+id).modal('show');
    });

    $(document).on('submit', '.editAboutUsForm', function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var formData = new FormData($('#editAboutUsForm'+id)[0]);

      $.ajax({
        url: "/includes/about-us-edit.php",
        method: "POST",
        dataType: "TEXT",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          console.log(data);
          if (data == "Failed") {
            swal({
              title: "Failed to update aboustus information. Please try again later.",
              icon: "error"
            });

          }else {
            swal({
              title: "About Us has been successfully updated.",
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