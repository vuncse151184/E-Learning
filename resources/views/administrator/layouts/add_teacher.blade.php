<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Teaching system</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  {{-- {{asset('assets/images/image.png')}} --}}
  <link rel="stylesheet" href="/assets/assets/css/font-awesome/all.min.css">

  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->

  <!-- Select2 -->
  <link rel="stylesheet" href="/assets/assets/css/select2/select2.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/assets/css/adminlte/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Admin Custom Style -->
  <link rel="stylesheet" href="/assets/assets/css/admin-custom.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <a class="nav-link menu-btn" data-widget="pushmenu" href="#!" role="button"><i class="fas fa-bars"></i></a>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <!-- <img src="/assets/assets//assets/assets/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> -->
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can.</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <!-- <img src="/assets/assets//assets/assets/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <!-- <img src="/assets/assets//assets/assets/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            {{Auth::guard('administrator')->user()->name}} <i class="fas fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <section class='add'>
  <aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="#!" class="brand-link">
        {{-- {{asset('assets/images/image.png')}} --}}
      <img src="{{asset('/assets/assets/img/logo-branch-image.png')}}" alt="ssdfssdLogo PrimeDX Image" class="brand-image">
      <img src="/assets/assets/img/logo-branch-text.png" alt="Logo PrimeDX Text" class="brand-text">
    </a>

    <!-- Sidebar -->
        @section('add-teacher')
        <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
                <a href="#!" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{url("/administrator/teacher-list")}}" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
                <p>List Teacher</p>
                </a>
            </li>
            {{-- <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-list-ul"></i>
                <p>Recruitment management</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>News Management <i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#!" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dropdown 01</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#!" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dropdown 02</p>
                    </a>
                </li> --}}
                </ul>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    @show
        </div>
    <!-- /.sidebar -->

  </aside>
  </section>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>
    <!-- End Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">

                  <div class = "container">
                    @yield('content')
                  </div>



          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-sm-block">
      &copy; Copyright 2020 <a href="https://primestyle.co.jp/" title="Primegroup" target="_blank">Primegroup</a>. All Rights Reserved
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/assets/assets/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
<!-- Bootstrap 4 -->
<script src="/assets/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="/assets/assets/js/select2/select2.full.min.js"></script>
<!-- custom-file-input -->
<script src="/assets/assets/js/plugins/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/assets/js/adminlte/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/assets/js/demo.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    // custo input file
    bsCustomFileInput.init();
    $('#created_date, #birthday').datetimepicker({
      format: 'L',
      locale: 'ja'
    });
  });
</script>
</body>
</html>
