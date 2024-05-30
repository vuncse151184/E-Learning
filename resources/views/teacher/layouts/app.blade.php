<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Teaching system</title>

    <!-- Favicon -->
    <!-- <link href="images/favicon.ico" rel="shortcut icon" /> -->

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">

    <!-- CSS Global Compulsory (Do not remove)-->
    <link rel="stylesheet" href="/assets/assets/css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="/assets/assets/css/flaticon/flaticon.css" />
    <link rel="stylesheet" href="/assets/assets/css/bootstrap/bootstrap.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

    <!-- font awesome 5.13.1 -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/assets/css/adminlte/adminlte.min.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Page CSS Implementing Plugins (Remove the plugin CSS here if site does not use that feature)-->
    <!-- SweetAlert2-->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Template Style -->
    <link rel="stylesheet" href="/assets/assets/css/style.css" />

    <!-- Custom Style for PrimeDX -->
    <link rel="stylesheet" href="/assets/assets/css/custom.css" />
</head>

<body>
    <!--=================================
header -->

    <!--=================================
header -->

    <!--=================================
inner banner -->
    <div class="header-inner bg-light header-inner-custom">
        <div class="container">
            <div class="row">
                <div class="jobber-user-info col-md-6">
                    <form action="{{ route('teacher.uploadimg') }}" id="userimg_frm" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-avatar">
                            @if (Auth::guard('teacher')->user()->image != null)
                                <div>
                                    <img class="img " src={{ asset(Auth::guard('teacher')->user()->image) }}
                                        alt="Avatar not found" id="img" style="width: 95px; height: 90px">

                                </div>
                            @elseif(Auth::guard('teacher')->user()->image == null)
                                <img class="img " src="/assets/assets/img/avatar.png"
                                    alt="/assets/assets/img/avatar.png" id="img"
                                    style="width: 95px; height: 90px">
                            @endif

                            <label for="imgbtn"><i class="fa fa-camera" aria-hidden="true"></i></i></label>
                            <input style="display: none" type="file" name="img_upload" id="imgbtn">

                        </div>
                    </form>
                    <div class="profile-avatar-info ml-4">
                        <h3>Teacher: {{ Auth::guard('teacher')->user()->name }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--=================================
inner banner -->

    <!--=================================
Dashboard Nav -->
    <section class="job-tab">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sticky-top secondary-menu-sticky-top">
                        <div class="secondary-menu">
                            <ul class="nav-list">
                                <li><a id="toProfile" class="{{ Request::path() == 'teacher/profile' ? 'active' : '' }}" class="menu"
                                        href="{{ url('/teacher/profile') }}" title="Profile">Profile</a></li>
                                <li><a class="{{ Request::path() == 'teacher/lesson/list' ? 'active' : '' }}"
                                        class="menu" href="{{ url('/teacher/lesson/list') }}"
                                        title="Lesson List">Lesson List</a></li>
                                <li><a class="{{ Request::path() == 'teacher/question/list' ? 'active' : '' }}"
                                        class="menu" href="{{ url('/teacher/question/list') }}"
                                        title="Question List">Question List</a></li>
                                <li><a class="{{ Request::path() == 'teacher/#' ? 'active' : '' }}" class="menu"
                                        href="#!" title="Most Liked Lesson">Most Liked Lesson</a></li>
                                <li><a class="{{ Request::path() == 'teacher/password/change' ? 'active' : '' }}"
                                        class="menu" href="{{ url('teacher/password/change') }}"
                                        title="Change Password">Change Password</a></li>
                                <li>
                                    <div class="container text-right">
                                        <a href="{{ url('/teacher/logout') }}" title="Sign-out"><i
                                                class="fa fa-sign-out fa-2xl" aria-hidden="true"></i></a>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
Dashboard Nav -->

    <!--=================================
Employer Dashboard -->
    <section class="job-lst-cont">
        <div class="container">
            @yield('content')
        </div>
    </section>
    <!--=================================
Employer Dashboard -->

    <!--=================================
footer-->
    <footer class="footer bg-light">
        <div class="position-relative">
            <svg class="footer-shape" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="100%" height="85px">
                <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                    d="M-0.000,-0.001 L1923.000,-0.001 L1923.000,84.999 C1608.914,41.669 1279.532,19.653 962.500,19.000 C635.773,18.326 323.692,40.344 -0.000,84.999 C-0.000,-83.334 -0.000,168.332 -0.000,-0.001 Z" />
            </svg>
        </div>

    </footer>
    <!--=================================
footer-->

    <!--=================================
Back To Top-->
    <div id="back-to-top" class="back-to-top">
        <i class="fas fa-angle-up"></i>
    </div>
    <!--=================================Back To Top-->

    <!--=================================Javascript -->

    <script src="/assets/assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <!-- Bootstrap 4 -->
    <script src="/assets/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="/assets/assets/js/select2/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/assets/js/adminlte/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/assets/assets/js/demo.js"></script>

    <!-- Page JS Implementing Plugins (Remove the plugin script here if site does not use that feature)-->
    <script src="/assets/assets/js/custom.js"></script>
    <!-- Template Scripts (Do not remove)-->
    <link rel="stylesheet" href="/assets/assets/css/admin-custom.css">
    
    <script>
        $(document).ready(function() {
            $('#toProfile').click(function(e){
                
                // e.preventDefault()
                // console.log(123)
                // $.ajax({
                //     type: "get",
                //     url: "{{ route('teacher.profile') }}",
      
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     success: function(response) {
                //       console.log(response);
                //        history.pushState({}, "", "{{ route('teacher.profile') }}");
                //        document.open();
                //        var script = document.createElement('script');  
                //         script.src = "response";  
                //         document.head.appendChild(script);
                
                //     },
                 
                // })
            })
            $('#toLessonList').click(function(e){

            })
            $('#imgbtn').change(function() {
                console.log($(this).val())
                let form = document.getElementById('userimg_frm')
                let data = new FormData(form)
                data.getAll('img_upload')
                $.ajax({
                    type: "POST",
                    url: "{{ route('teacher.uploadimg') }}",
                    contentType: false,
                    cache: false,
                    processData: false,
                    enctype: "multipart/form-data",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        window.location.reload()                  
                    },
                    error: function(err) {

                    },
                })
            })
        })
    </script>



</body>
<style>
                
    .form-control:hover {
        border-color: #1dbfaf;
    }

    .form-group.invalid .form-control {
        border-color: #f33a58;
    }

    .form-group.invalid .form-message {
        color: #f33a58;
    }

    .form-message {
        font-size: 1rem;
        line-height: 1.6rem;
        padding: 5px 0 0;
    }

    .form-submit {
        outline: none;
        background-color: #1dbfaf;
        margin-top: 12px;
        padding: 12px 16px;
        font-weight: 600;
        color: #fff;
        border: none;
        width: 100%;
        font-size: 14px;
        border-radius: 8px;
        cursor: pointer;
    }

</style>
</html>
