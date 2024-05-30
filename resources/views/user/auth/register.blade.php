<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/assets/css/font-awesome/all.min.css">
    <!-- CSS only -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                <form class="mx-1 mx-md-4" id="frm-register" method="post"
                                    action="{{ route('user.register') }}">
                                    @csrf
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="Your Name" />
                                            <span class="form-message"> </span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Your Email" />
                                            <span class="form-message"> </span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Password" />
                                            <span class="form-message"> </span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="confirm-password" name="password-confirm"
                                                class="form-control" placeholder="Repeat your password" />
                                            <span class="form-message"> </span>
                                        </div>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <input class="form-check-input me-2" type="checkbox" value=""
                                            id="form2Example3c" />
                                        <label class="form-check-label" for="form2Example3">
                                            I agree all statements in <a href="#!">Terms of service</a>
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="button" class="btn btn-primary btn-lg"
                                            id="btn-register">Register</button>
                                    </div>

                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                    class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
    span{
        color:red
    }
</style>
<script src="{{ asset('/js/validator.js') }}"></script>
<script>
    Validator({
        form: '#frm-register',
        rules: [
            Validator.isEmail('#email'),
            Validator.isRequired('#name'),
            Validator.minLength('#password', 6),
            Validator.isConfirmed('#confirm-password', function() {
                return $('#frm-register #password').val()
            }),
        ]
    })
</script>
<script>
    $(document).ready(function() {
        $('#btn-register').click(function() {
            let form = document.getElementById('frm-register')
            let data = new FormData(form)
            let name = data.getAll('name').pop()
            let email = data.getAll('email').pop()
            let password = data.getAll('password').pop()
            console.log(name)
            $.ajax({
                type: "POST",
                cache: false,
                url: "<?= route('user.register') ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: name,
                    email: email,
                    password: password
                },
                success: function(response) {
                    swal.fire({
                        text: 'Register success! Redirecting to login',
                        icon: 'success',
                    }).then(() => {
                        window.location = '{{ route('home.login') }}'
                    })


                },
                error: function(er) {
                    console.log(er)
                }
            });
        })
    })
</script>
