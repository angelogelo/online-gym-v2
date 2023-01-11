<?php 
  
  include'../includes/connection.php';

  if (isset($_SESSION['admin'])) {

      $username = $_SESSION['admin'];
      $admin = $pdo->prepare("SELECT * FROM admin WHERE admin_id = '".$username."'");
      $admin->execute();
      $adminData = $admin->fetch(PDO::FETCH_ASSOC);

      $emp_type = "admin";
      

  }else {

    echo '<script>window.location.href="/";</script>';

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>(O-GHIMS) - Online Gym Information With Health Monitoring System</title>

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <link href="../assets/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="../assets/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
  <!-- Logo -->
  <link rel="icon" href="../images/logo.ico">
  <!-- summernote -->
  <link rel="stylesheet" href="../assets/plugins/summernote/summernote-bs4.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet">

  <style>

    body{
      font-family: 'Nunito', sans-serif;
    }
    th{
      text-align: center;
    }

    td{
      text-align: center;
    }

  </style>

</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-warning">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-indent" style="transform: rotate(180deg); color: black;"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
          <a href="../includes/logout.php" class="nav-link" style="color: black;">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-warning elevation-4" style="background-color: #f8f9fa;">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
          <img src="../images/logo.ico" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light" style="color: black;">GYM Management</span>
        </a>

      <!-- Sidebar -->
      <div class="sidebar text-sm">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-header" style="color: black;">HOME</li>

            <li class="nav-item">
              <a href="index.php" class="nav-link" style="color: black;">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p >
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-header" style="color: black;">MANAGEMENT</li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link" style="color: black;">
                <i class="nav-icon fas fa-user-circle"></i>
                <p>
                  Client Management
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/client/client.php" class="nav-link" style="color: black;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Client</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="client-list.php" class="nav-link" style="color: black;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Client</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link" style="color: black;">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Membership Plans
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="membership-plan.php" class="nav-link" style="color: black;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Membership Plans</p>
                  </a>
                </li>
              </ul>
              <!-- <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="view-membership-list.php" class="nav-link" style="color: black;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Membership Plans</p>
                  </a>
                </li>
              </ul> -->
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link" style="color: black;">
                <i class="nav-icon fas fa-suitcase"></i>
                <p>
                  Manage Subscriptions
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="subscription.php" class="nav-link" style="color: black;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Subscriptions</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="subscription-list.php" class="nav-link" style="color: black;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Subscriptions</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link" style="color: black;">
                <i class="nav-icon fas fa-dumbbell"></i>
                <p>
                  Coach Management
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="coach.php" class="nav-link" style="color: black;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Coach</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="coach-list.php" class="nav-link" style="color: black;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Coach</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="coach-skills.php" class="nav-link" style="color: black;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Coach Skills</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-header" style="color: black;">Report</li>

            <li class="nav-item">
              <a href="index.php" class="nav-link" style="color: black;">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p >
                  Reports
                </p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
