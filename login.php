<?php 
  include'includes/connection.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>LOG IN PAGE</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
        
    <!-- Custom fonts for this template-->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Icon -->
    <link rel="icon" href="images/logo.ico">
</head>
<body class="hold-transition login-page" style="background-image: url(images/gym.jpg); background-size: cover;">
    <div class="login-box">
        <div class="login-logo">
            <h3></h3>
        </div><!-- /.login-logo -->
        
        <div class="card card-warning card-outline">
            <div class="card-body login-card-body">
                <div class="login-logo">
                    <img class="user-image img-circle elevation-2" src="images/logo.ico" style="width: 200px;">
                </div>
                    <p class="login-box-msg">Log in to start your session</p>

                <form action="" method="post" id="loginForm">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" id="username" name="username" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card-alt"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-success btn-block" id="loginButton"><i class="fas fa-sign-in-alt"></i> Log In</button>
                        </div><!-- /.col -->
                    </div>
                </form>
            </div><!-- /.card-body -->
        </div><!-- /-card -->
    </div><!-- /.login-box -->
    
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- Sweetalert -->
<script src="assets/sweetalert/sweetalert.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#loginForm').submit(function(e) {
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $('#loginButton').text("Logging in");

      $.ajax({
        url: "includes/login.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data) {
          console.log(data);
          
          $('#loginButton').text("Login");
          if (data == "No Account") {
            swal({
              title: "Account not found, please check your spelling and try again.",
              icon: "warning"
            }).then(function(){
              $('#loginButton').val("Log in");
            });
          }else if (data == "Deactivated") {
            swal({
              title: "Opps, your account has been deactivated.",
              icon: "warning"
            });
          }else if (data == "Pending") {
            swal({
              title: "Opps, your account is still pending/deactivated. Please wait for it to be approved.",
              icon: "warning"
            });
          }else {
            if (data == "client") {
              swal({
                 type: 'success',
                 title: "Welcome Client!",
                 icon: "success"
               }).then(function(){
                 window.location.href = 'client/';
               });
            }else if (data == "coach") {
              swal({
                 type: 'success',
                 title: "Welcome Coach!",
                 icon: "success"
               }).then(function(){
                 window.location.href = 'coach/';
               });
            }else {
              swal({
                 type: 'success',
                 title: "Welcome Administrator!",
                 icon: "success"
               }).then(function(){
                 window.location.href = 'admin/';
               });
            }
          }
        }
      });
    });

    if($('#username').val() == '') {
      $('#username').focus();
    } else {
      $('#password').focus();
    }

  });
</script>

</body>
</html>