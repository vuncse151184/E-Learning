@extends('teacher.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">

            <form id="profilefrm">
                @csrf
                <div class="user-dashboard-info-box need-validation " id="profile">
                    <div class="col-md-12 text-right pl-5">
                        <button style="font-size:25px" class="btn to_hide" id="btn_edit">
                            <i class="fa fa-pencil-square-o fa-2xl" aria-hidden="true"></i>
                        </button>
                    </div>
                    <!-- Form group -->
                    <div class="form-group col-md-12 " style="display:none" id="btn_cancel">
                        <div class="row">
                            <a class="btn text-left col-md-5" href="/teacher/profile"> <i class="fa fa-chevron-left"
                                    aria-hidden="true"></i></a>
                            <h3 class="text-center">Edit profile</h3>
                        </div>


                    </div>
                    <!-- Form Row -->
                    <div class="form-row">
                        <!-- Form group -->
                        <div class="form-group col-md-6">
                            <label for="email" class="font-weight-bold">EMAIL</label>
                            <p class="frm-show-data to_hide">{{ Auth::guard('teacher')->user()->email }}</p>
                            <input type="email" style="display:none" value="{{ Auth::guard('teacher')->user()->email }}"
                                name="email" id="email" class="form-control input_hidden"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                placeholder="abc@gmail.com">
                            <span class="form-message"></span>

                        </div>
                        <!-- End Form group -->

                        <!-- Form group -->
                        <div class="form-group col-md-6 datetimepickers">
                            <label for="password" class="font-weight-bold">BIRTHDAY</label>

                            <p class="frm-show-data to_hide">{{ Auth::guard('teacher')->user()->birthday }}</p>
                            <input name="birthday" style="display:none" type="date" class="form-control input_hidden"
                                id="birthday" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                value="{{ Auth::guard('teacher')->user()->birthday }}">
                            <span class="form-message"></span>
                        </div>
                        <!-- End Form group -->
                    </div>
                    <!-- End Form Row -->

                    <!-- Form Row -->
                    <div class="form-row">
                        <!-- Form group -->
                        <div class="form-group col-md-6  ">
                            <label class="font-weight-bold">PHONE</label>
                            <p class="frm-show-data to_hide"> {{ Auth::guard('teacher')->user()->phone }}</p>
                            <input name="phone" type="text" class="form-control input_hidden" style="display:none"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="phone"
                                value="{{ Auth::guard('teacher')->user()->phone }}" placeholder="Phone number">
                            <span class="form-message text-center" style="color: red"></span>
                        </div>
                        <!-- End Form group -->

                        <!-- Form group -->
                        <div class="form-group col-md-6">

                            <label for="status" class="font-weight-bold">GENDER</label>
                            <a href=""></a>
                            <p class="frm-show-data to_hide">
                                {{ Auth::guard('teacher')->user()->gender == 1 ? 'Male' : 'Female' }}</p>

                            <select name="gender" style="display:none" class="form-control input_hidden"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                class="form-select input_hidden" aria-label="Default select example">
                                <option {{ Auth::guard('teacher')->user()->gender == 1 ? 'Selected' : '' }} value="1">
                                    Male</option>
                                <option {{ Auth::guard('teacher')->user()->gender == 0 ? 'Selected' : '' }} value="0">
                                    Female</option>

                            </select>
                        </div>
                        <input type="button" style="display:none" class="btn btn-primary input_hidden" id="btn_save"
                            value="SAVE">



                        <!-- End Form group -->
                    </div>
                    <!-- End Form Row -->

                </div>
            </form>
        </div>
    </div>
    </div>
    <!-- VALIDATION -->
    <script src="{{ asset('/js/validator.js') }}"></script>
    <script>
        console.log('Hello');
        Validator({
            form: '#profilefrm',
            rules: [
                Validator.isRequired('#phone'),
                Validator.isEmail('#email'),
                Validator.validDate('#birthday')
            ]
        })
    </script>

    <script>
        $(document).ready(function() {

            $('#birthday').change(function() {
                $('#birthday').html($(this).val())
            })
            //console.log($('#profilefrm'))
            $('#btn_edit').click(function(e) {
                e.preventDefault()
                $('#btn_edit').hide()
                $('.to_hide').hide()
                $('#btn_cancel').removeAttr("style")
                $('.input_hidden').removeAttr("style")
                //let html ='';
                // html = add();
                // $('#profile').html(html) 
            })
            $('#btn_save').click(function(e) {

                $('.form-message').each(function(e) {
                    if ($('.form-message').text() != "") {
                        e.preventDefault()
                    }
                    let form = document.getElementById('profilefrm')
                    let data = new FormData(form)
                    console.log(data.getAll('email'))
                    $.ajax({
                        type: "post",
                        url: "<?= route('teacher.profile.update') ?>",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        cache: false,
                        processData: false,
                        contentType: false,
                        data: data,
                        success: function(response) {
                            Swal.fire({
                                text: 'Saved',
                                icon: 'success',

                            }).then(() => {
                                window.location.reload()
                            })
                        }
                    })
                })



            })
        })
    </script>

@stop
