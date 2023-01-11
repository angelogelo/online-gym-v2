<?php 
  $page = 'coach-list';
  include 'header.php'; 
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Coach List</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">

    <div class="card card-warning card-outline">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-bar mr-1"></i>
          List of Coach
        </h3>
      </div>
      <div class="card-body">
        
        <table id="coachTable" class="table table-bordered table-hover text-nowrap table-sm">
          <thead>
          <tr>
            <th class="table-plus datatable-nosort" >No</th>
            <th>Status</th>
            <th>Photo</th>
            <th>Coach ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Skills</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>

            <?php

              $number = 1;
              $coach = $connection->query("SELECT * FROM coach");
              while($coachData = $coach->fetch_array()){

                $birthDate = new DateTime($coachData['birthDate']);
                $age = $birthDate->diff(new DateTime);

                $coachSkill = $connection->query("SELECT * FROM skills WHERE id = '".$coachData['coach_skills_id']."'");
                $coachSkillData = $coachSkill->fetch_array();

                $id = $coachData['id'];
                
            ?>
            <tr>
              <td> <?= $number++; ?> </td>
              <td> 

                <?php  
                  if ($coachData['status'] == "active") {
                    ?>
                      <i class="fas fa-circle text-success"></i>
                    <?php
                  }else {
                    ?>
                      <i class="fas fa-circle text-danger"></i>
                    <?php
                  }
                ?>
                  

              </td>
              <td> 

                <?php  
                  if ($coachData['picture'] == "none" || $coachData['picture'] == NULL) {
                    ?>
                      <img src="../images/no_image.png" class="img-fluid rounded" style="width: 40px; height: 30px;">
                    <?php
                  }else {
                    ?>
                      <img src="../images/coach/<?php echo $coachData['picture']; ?>" class="img-fluid rounded" style="width: 40px; height: 30px;">
                    <?php
                  }
                ?>

              </td>
              <td> <?= $coachData['coach_id']; ?> </td>
              <td> <?php echo $coachData['lastname'].", ".$coachData['firstname']." ".$coachData['middlename']; ?> </td>
              <td> <?= $age->y; ?> </td>
              <td> <?= $coachSkillData['skills_name']; ?> </td>
              <td>

                <!-- View -->
                <button class="btn btn-outline-primary btn-xs viewCoach" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $coachData['id']; ?>"><i class="fas fa-eye"></i></button>

                <!-- Edit -->
                <!-- <a href="/edit-coach/<?= urlencode(base64_encode($id)); ?>" class="btn btn-outline-success btn-xs" data-tooltip="tooltip" title="Click to Edit">
                  <i class="fa fa-edit"></i>
                </a> -->

                <button class="btn btn-outline-success btn-xs edit-coach" data-tooltip="tooltip" title="Click to Edit" data-id="<?php echo $coachData['id']; ?>"><i class="fas fa-edit"></i></button>

                <!-- Delete -->
                <!-- <button type="button" class="btn btn-outline-danger btn-xs"><i class="fas fa-trash-alt"></i></button> -->
              </td>
            </tr>

            <div class="modal fade" id="viewCoach<?php echo $coachData['id']; ?>">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">
                      <i class="fas fa-info-circle"></i> Coach Information
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="card card-warning card-outline">
                          <div class="modal-header">
                            <h4 class="modal-title">
                              <i class="fas fa-info-circle"></i> About Me
                            </h4>
                          </div>
                          <div class="card-body box-profile">
                            <div class="form-group">
                              <div class="text-center">
                                <?php  
                                  if ($coachData['picture'] == "none" || $coachData['picture'] == NULL) {
                                    ?>
                                      <img src="/images/no_image.png" class="profile-user-img img-fluid img-circle">
                                    <?php
                                  }else {
                                    ?>
                                      <img src="/images/coach/<?php echo $coachData['picture']; ?>" class="profile-user-img img-fluid img-circle">
                                    <?php
                                  }
                                ?>
                              </div>

                              <h3 class="profile-username text-center" style="font-size: 20px;"><?php echo $coachData['firstname']." ".$coachData['middlename']." ".$coachData['lastname']; ?></h3>

                              <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                  <i class="fas fa-calendar-minus text-sm"></i> <b>Age</b>
                                  <a class="float-right"><?= $age->y; ?></a>
                                </li>
                                <li class="list-group-item">
                                  <i class="far fa-calendar-alt text-sm"></i> <b>Birthday</b>
                                  <a class="float-right"><?= date('M d, Y', strtotime($coachData['birthDate'])); ?></a>
                                </li>
                                <li class="list-group-item">
                                  <i class="fas fa-info text-sm"></i> <b>Status</b>
                                  <a class="float-right"><?php  
                                    if ($coachData['status'] == "active") {
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
                        </div><!-- /.card-body -->
                      </div><!-- /.col -->

                      <div class="col-lg-8">
                        <div class="card card-warning card-outline">
                          <div class="card-header">
                            <h4 class="card-title">Contact Details</h4>
                          </div>
                          <div class="card-body">
                            
                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                <i class="fas fa-id-card-alt text-sm"></i> <b>Coach ID</b>
                                  <a class="float-right">
                                    <?= $coachData['coach_id']; ?>
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-venus-mars text-sm"></i> <b>Gender</b>
                                  <a class="float-right">
                                    <?= $coachData['gender']; ?>
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-phone text-sm"></i> <b>Phone Number</b>
                                <a class="float-right">
                                  <?= $coachData['contact_no']; ?>
                                </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-map-marked-alt text-sm"></i> <b>Address</b>
                                <a class="float-right">
                                  <?= $coachData['address']; ?>
                                </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-map-marked-alt text-sm"></i> <b>Skills</b>
                                <a class="float-right">
                                  <?= $coachSkillData['skills_name']; ?>
                                </a>
                              </li>
                            </ul>

                          </div><!-- /.card-body -->
                        </div><!-- /.card -->
                      </div><!-- /.col -->

                    </div><!-- /.row -->
                  </div><!-- /.modal-body -->
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <?php } ?>
          </tbody>
        </table>

      </div>
    </div>
  </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click', '.viewCoach', function(){
      var id = $(this).attr('data-id');
      $('#viewCoach'+id).modal('show');
    });

    $(document).on('click', '.edit-coach', function(){
      var id = $(this).attr('data-id');
      window.location.href = 'coach-edit.php?id='+id;
    });

    $('#coachTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

  });
</script>