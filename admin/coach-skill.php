<?php 
  $page = 'coach-skills';
  include 'header.php'; 
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add Coach Skills</h1>
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
        <form action="" method="POST" enctype="multipart/form-data" id="addSkillsForm">
          <div class="card card-warning card-outline">
            <div class="card-header">
              <h4 class="card-title">Coach Skills Form</h4>
            </div>
            <div class="card-body">
              
              <div class="form-group">
                <span><b>Coach Skills</b></span>
                <input type="text" class="form-control form-control-sm" name="skills_name" placeholder="Enter Coach Skills" required>
              </div>

            </div><!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-outline-success"><i class="fas fa-save"></i> Save</button>
            </div>
          </div><!-- /.card -->
        </form>
      </div><!-- /.col -->

      <div class="col-lg-8">
        <form action="" method="POST" enctype="multipart/form-data" id="addSkillsForm">
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
                  <th>Created At</th>
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
                    <td> <?= date('M d, Y', strtotime($skillsData['created_at'])); ?> </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </form>
      </div><!-- /.col -->

    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content -->
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