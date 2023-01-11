<?php

  $page = 'announcements';
  include 'header.php';
  
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="nav-icon fas fa-bullhorn"></i> Announcements</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content-header -->


<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addAnnouncement">
                    <i class="fas fa-plus-circle nav-icon"></i> | Add Announcements
                </button><br><br>

                <div class="card card-warning card-outline">
                    <div class="card-body">
                        <table id="announcementTable" class="table table-bordered table-hover text-nowrap table-sm">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort" >No</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $announcements = $connection->query("SELECT * FROM announcement");
                                    $number = 1;
                                    while($announcementsRow = $announcements->fetch_array()){

                                    $announcementId = $announcementsRow['id'];
                                    $announcementCms = $announcementsRow['cms'];
                                ?>
                                <tr>
                                    <td><?php echo $number++; ?></td>
                                    <td><?=$announcementsRow['title'];?></td>
                                    <td><?php echo date('M d, Y', strtotime($announcementsRow['created_at'])); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-xs clickMe <?php echo ($announcementCms == 'false') ? "btn-outline-success" : "btn-outline-danger"; ?>" data-id="<?php echo $announcementId; ?>" id="clickMeButton<?php echo $announcementId; ?>" value="<?php echo $announcementCms; ?>"><?php echo ($announcementCms == 'false') ? "Display" : "Hide"; ?></button>

                                        <!-- View -->
                                        <button data-tooltip="tooltip" title="Click to View" class="btn btn-outline-success btn-xs viewAnnouncement" data-toggle="tooltip" data-placement="top" data-id="<?php echo $announcementsRow['id']; ?>"><i class="fa fa-eye"></i></button>

                                        <!-- Edit -->
                                        <button type="button" class="btn btn-outline-primary btn-xs" data-toggle="modal" data-target="#editAnnouncement<?php echo $announcementsRow['id']; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Click to Edit"></i></button>

                                        <!-- Delete -->
                                        <button type="button" class="btn btn-outline-danger btn-xs deleteAnnouncement" data-id="<?php echo $announcementsRow['id']; ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editAnnouncement<?php echo $announcementsRow['id']; ?>">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">
                                                    <i class="fas fa-info-circle"></i> Announcement Information
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="" method="POST" class="editAnnouncementForm" id="editAnnouncementForm<?php echo $announcementsRow['id']; ?>" data-id="<?php echo $announcementsRow['id']; ?>" enctype="multipart/form-data">
                                            <div class="modal-body">

                                                <div class="form-group row">
                                                    <div class="col-lg-12">
                                                        <label>Title</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fab fa-tumblr"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control form-control-sm" name="edit_title" value="<?=$announcementsRow['title'];?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-12">
                                                        <label>Description</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-info"></i></span>
                                                            </div>
                                                            <input class="form-control form-control-sm" name="edit_description" value="<?=$announcementsRow['description'];?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-12">
                                                        <label>Date</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" class="form-control form-control-sm" name="edit_created_at" value="<?=$announcementsRow['created_at'];?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div><!--modal-body-->
                                                <div class="modal-footer justify-content-between">
                                                    <input type="hidden" name="update_id" value="<?=$announcementsRow['id'];?>">
                                                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-save"></i> | Update</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->


                            <div class="modal fade" id="viewAnnouncementModal<?php echo $announcementsRow['id']; ?>">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                <i class="fas fa-info-circle"></i> Announcement's Information
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label class="col-form-label">Title</label>
                                                    <p class="h6"><?=$announcementsRow['title'];?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label class="col-form-label">Description</label>
                                                    <p class="h6"><?=$announcementsRow['description'];?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label class="col-form-label">Date</label>
                                                    <p class="h6"><?php echo date('M d, Y', strtotime($announcementsRow['created_at'])); ?></p>
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
        </div><!-- /.row-->
    </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php' ?>

<div class="modal fade" id="addAnnouncement">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fas fa-bullhorn"></i> Announcements
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="announcement-add">
                <div class="modal-body">

                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>Title</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fab fa-tumblr"></i></span>
                            </div>
                            <input type="text" class="form-control form-control-sm" name="title" pattern="^[^\s].+[^\s]$" title="No WhiteSpace" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>Description</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-info"></i></span>
                            </div>
                            <textarea class="form-control form-control-sm" rows="3" name="description" pattern="^[^\s].+[^\s]$" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="date" class="form-control form-control-sm" name="created_at" required>
                        </div>
                    </div>
                </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-save"></i> | Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  $(document).ready(function(){

    $('#announcementTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $(document).on('click', '.viewAnnouncement', function(){
      var id = $(this).attr('data-id');
      $('#viewAnnouncementModal'+id).modal('show');
    });

    $(document).on('click', '.deleteAnnouncement', function() {
      var id = $(this).attr('data-id');
      swal({
        title: "Are you sure you want to delete this Announcement?",
        text: "PROCEED WITH CAUTION!!!",
        icon: "info",
        buttons: {
          cancel: "Cancel",
          confirm: "Confirm"
        }
      }).then(function(event) {
        if (event == true) {
          $.ajax({
            url: "/includes/announcement-delete.php",
            method: "POST",
            dataType: "TEXT",
            data: {
              id: id
            }, success: function(data) {
              console.log(data);
              if (data === "Deleted") {
                swal({
                  title: "Announcement has been deleted!",
                  text: "You can't recover this deleted Announcement!",
                  icon: "info"
                }).then(function() {
                  location.reload();
                });
              } else {
                swal({
                  title: "Failed to delete this Announcement!",
                  icon: "info"
                });
              }
            }
          })
        }
      });
    });

    $(document).on('submit', '.editAnnouncementForm', function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var formData = new FormData($('#editAnnouncementForm'+id)[0]);

      $.ajax({
        url: "/includes/announcement-edit.php",
        method: "POST",
        dataType: "TEXT",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          console.log(data);
          if (data == "Failed") {
            swal({
              title: "Failed to update announcement information. Please try again later.",
              icon: "error"
            });

          }else {
            swal({
              title: "Announcement has been successfully updated.",
              icon: "success"
            }).then(function(){
              location.reload();
            });
          }
        }
      })
    });
    
    $('#announcement-add').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "/includes/announcement-add.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Taken") {
            swal({
              type:'error',
              title: "Contact already exist.",
              icon: "warning"
            }); 

            }else if (data == "Failed") {
            swal({
              type:'error',
              title: "Failed to add announcement. Please try again later.",
              icon: "error"
            });

          }else {
            swal({
              type:'success',
              title: "Announcement has been added.",
              icon: "success"
            }).then(function(){
              location.reload();
            });
          }
        }
      })
    });


    //display and hide
    $(document).on('click', '.clickMe', function() {
      var id = $(this).attr('data-id');
      var value = $(this).val();

      if (value == "false") {
        $('#clickMeButton'+id).text("Hide");
        $('#clickMeButton'+id).removeClass("btn-outline-success");
        $('#clickMeButton'+id).addClass("btn-outline-danger");
        $('#clickMeButton'+id).val("true");
        value = "true";
      } else {
        $('#clickMeButton'+id).text("Display");
        $('#clickMeButton'+id).removeClass("btn-outline-danger");
        $('#clickMeButton'+id).addClass("btn-outline-success");
        $('#clickMeButton'+id).val("false");
        value = "false";
      }

      $.ajax({
        url: "../includes/announcementsCms.php?id=" + id +"&cms="+ value,
        method: "GET",
        dataType: "TEXT",
        success: function(data) {
          console.log(data);
        }
      });
    });

  });
</script>