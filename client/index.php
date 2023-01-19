<?php 
  $page = 'dashboard';
  include 'header.php';
?>

<style>
	a{
		color: black;
	}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Client Information</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<button class="btn btn-warning btn-sm edit-client" data-tooltip="tooltip" title="Click to Edit" data-id="<?php echo $clientData['id']; ?>"><i class="fas fa-edit"></i> Edit Information</button>
				</ol>
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
					<div class="card-body">
						<div class="text-center">
							<?php  
								if ($clientData['picture'] == "none" || $clientData['picture'] == NULL) {
							?>
									<img src="/images/no_image.png" class="img-fluid rounded">
							<?php
								}else {
							?>
									<img src="/images/client/<?= $clientData['picture']; ?>" class="img-fluid rounded">
							<?php
								}
							?>
							<h3 class="profile-username text-center" style="font-size: 20px;"><?= $clientData['firstname']." ".$clientData['middlename']." ".$clientData['lastname']; ?></h3>
						
							<ul class="list-group list-group-unbordered mb-3">
								<li class="list-group-item">
									<i class="fas fa-info text-sm"></i> <b>Status</b>
									<a class="float-right">
										<?php  
											if ($clientData['status'] == "active") {
										?>
												<i class="fas fa-circle text-success"></i>
										<?php
											}else {
										?>
												<i class="fas fa-circle text-danger"></i>
										<?php
											}
										?>
									</a>
								</li>
							</ul>

						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-8">
				<div class="card card-warning card-outline">
					<div class="card-body">
						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<i class="fas fa-venus-mars text-sm"></i> <b>Gender</b>
								<a class="float-right">
									<?= $clientData['gender']; ?>
								</a>
							</li>
							<li class="list-group-item">
								<i class="fas fa-phone text-sm"></i> <b>Phone Number</b>
								<a class="float-right">
									<?= $clientData['contact_no']; ?>
								</a>
							</li>
							<li class="list-group-item">
								<i class="fas fa-ruler-vertical text-sm"></i> <b>Height</b>
								<a class="float-right">
									<?= $clientData['height']; ?> cm
								</a>
							</li>
							<li class="list-group-item">
								<i class="fas fa-weight text-sm"></i> <b>Weight</b>
								<a class="float-right">
									<?= $clientData['weight']; ?> kg
								</a>
							</li>
							<li class="list-group-item">
								<i class="fas fa-child text-sm"></i> <b>BMI</b>
								<a class="float-right">
									<?= $clientData['bmi']; ?>
								</a>
							</li>
							<li class="list-group-item">
								<i class="fas fa-map-marked-alt text-sm"></i> <b>Address</b>
								<a class="float-right">
									<?= $clientData['address']; ?>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>

		</div><!-- ./row -->
	</div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php' ?>

<script>
	$(document).ready(function(){
	
		$(document).on('click', '.edit-client', function(){
			var id = $(this).attr('data-id');
			window.location.href = 'client-edit.php?id='+id;
		});
		
	});
</script>