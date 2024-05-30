<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Teaching system</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/assets/css/font-awesome/all.min.css">

    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->

    <!-- Select2 -->
    <link rel="stylesheet" href="../assets/assets/css/select2/select2.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/assets/css/adminlte/adminlte.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Admin Custom Style -->
    <link rel="stylesheet" href="../assets/assets/css/admin-custom.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <!-- Navbar -->

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <a class="nav-link menu-btn" data-widget="pushmenu" href="#!" role="button"><i
                    class="fas fa-bars"></i></a>

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
                                <!-- <img src="../assets/assets/../assets/assets/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> -->
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <!-- <img src="../assets/assets/../assets/assets/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
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
                                <!-- <img src="../assets/assets/../assets/assets/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
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
                        {{ Auth::guard('administrator')->user()->name }}<i class="fas fa-caret-down"></i>
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
                        <a href="{{ route('administrator.logout') }}" class="dropdown-item dropdown-footer">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary">
            <!-- Brand Logo -->
            <a href="#!" class="brand-link">
                <img src="../assets/assets/img/logo-branch-image.png" alt="Logo PrimeDX Image" class="brand-image">
                <img src="../assets/assets/img/logo-branch-text.png" alt="Logo PrimeDX Text" class="brand-text">
            </a>

            <!-- Sidebar -->
            <div class="sidebar mt-4">
                <section class="teacher-add">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview">
                                <a href="{{ url('/administrator/teacher-list') }}"
                                    class="nav-link {{ Request::path() == 'administrator/teacher-list' ? 'active' : '' }}">

                                    <i class="nav-icon fas fa-users"></i>
                                    <p>List Teacher</p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="{{ url('/administrator/tags-list') }}"
                                    class="nav-link {{ Request::path() == 'administrator/tags-list' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>Tags</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </section>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">

                </div><!-- /.container-fluid -->
            </section>
            <!-- End Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <!-- Form -->
                                    <form class="col-md-12 form-inline job-seeker-frm">
                                        <!-- Form Group -->
                                        <div class="form-group row col-md-3 status-input">
                                            <label for="status" class="col-md-6 col-form-label">Status</label>
                                            <div class="col-md-6">
                                                <select id="status" class="form-control select2"
                                                    style="width: 100%;">
                                                    <option selected="selected">All</option>
                                                    <option>Option 01</option>
                                                    <option>Option 02</option>
                                                    <option>Option 03</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <!-- Form Group -->
                                        <div class="form-group row col-md-7 date-input">
                                            <label for="created_date" class="col-md-3 col-form-label">
                                                Created Date</label>
                                            <div class="col-md-9 row">
                                                <div class="input-group date col-md-5" id="created_date_from"
                                                    data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#created_date_from" placeholder="2020/09/09">
                                                    <div class="input-group-append" data-target="#created_date_from"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i
                                                                class="far fa-calendar-alt"></i></div>
                                                    </div>
                                                </div>
                                                <span class="col-md-1 separate-icon">~</span>
                                                <div class="input-group date col-md-5" id="created_date_to"
                                                    data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#created_date_to" placeholder="2020/09/09">
                                                    <div class="input-group-append" data-target="#created_date_to"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i
                                                                class="far fa-calendar-alt"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <!-- Form Group -->
                                        <div class="form-group row col-md-2 search-input">
                                            <div class="col-md-12">
                                                <div class="input-group" style="width: 100%;">
                                                    <input type="text" name="table_search"
                                                        class="form-control float-right" placeholder="Search">

                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default"
                                                            style="min-width: 50px;"><i
                                                                class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->
                                    </form>
                                    <!-- Form -->
                                </div>
                                <!-- /.card-header -->
                                <div class="container">
                                    @yield('content')
                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-sm-block">
            &copy; Copyright 2020 <a href="https://primestyle.co.jp/" title="Primegroup"
                target="_blank">Primegroup</a>. All Rights Reserved
        </div>
    </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../assets/assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js">
    </script>
    {{-- <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" /> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- Bootstrap 4 -->
    <script src="../assets/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="../assets/assets/js/select2/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/assets/js/adminlte/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../assets/assets/js/demo.js"></script>
    <!--SweetAlert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Popperjs -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha256-BRqBN7dYgABqtY9Hd4ynE+1slnEw+roEPFzQ7TRRfcg=" crossorigin="anonymous"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();

            $('#created_date_from, #created_date_to').datetimepicker({
                format: 'L',
                locale: 'ja'
            });
        });
    </script>



</body>

</html>
