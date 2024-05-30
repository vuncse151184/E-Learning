@extends('administrator.layouts.add_teacher')
@section('content')
    <div class="card">
        <div class="card-body">
            <form id="edit-teacher-form" action="{{ url('/administrator/teacher-update/' . $teachers->id) }}" method="post">
                {!! csrf_field() !!}
                @method('PATCH')
                <!-- Row -->

                <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input id="id" type="text" class="form-control" value="{{ $teachers->id }}" readonly>
                        </div>
                    </div>
                </div>
                <!-- End Row -->

                <!-- Row -->
                <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Full name</label>
                            <input type="text" name="fullname" id="name" value="{{ $teachers->name }}"
                                class="form-control">
                                <span class="form-message"> </span>
                        </div>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" id="inputPassword" class="form-control"
                                placeholder="******">
                        </div>
                        <span class="form-message"> </span>
                    </div>
                    <!-- End Col 06 -->
                </div>
                <!-- End Row -->

                <!-- Row -->
                <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" name="email" id="email" value="{{ $teachers->email }}"
                                class="form-control" placeholder="abcdef@website.com">
                            <span class="form-message"> </span>
                        </div>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input id="phone" type="text" name="phone" value="{{ $teachers->phone }}"
                                class="form-control" placeholder="000-000-0000">
                            <span class="form-message"> </span>
                        </div>
                    </div>
                    <!-- End Col 06 -->
                </div>
                <!-- End Row -->

                <!-- Row -->
                <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="is_active">Is Active</label>
                            <div class="form-group form-inline">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="is_active" name="is_active"
                                        value="1" checked>
                                    <label for="is_active" class="custom-control-label">On</label>
                                </div>
                                <div class="custom-control custom-radio ml-3">
                                    <input class="custom-control-input" type="radio" id="is_not_active" name="is_active"
                                        value="0">
                                    <label for="is_not_active" class="custom-control-label">Off</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Col 06 -->

                </div>
                <!-- End Row -->

                <!-- Row -->
                <div class="row">
                    <div class="">
                        <button class="btn btn-secondary">

                            <a style="color:white; text-decoration:none"
                                href="{{ url('/administrator/teacher-list') }}">Back</a>
                        </button>
                    </div>

                    <div class="ml-3">
                        <input type="submit" value="Update" class="btn btn-success">
                    </div>
                    <!-- End Col 06 -->

                </div>
            </form>
        </div>
        <!-- End Row -->
    </div>
    <!-- /.card-body -->
    <script src="{{ asset('/js/validator.js') }}"></script>
    <script>
        Validator({
            form: '#edit-teacher-form',
            rules: [

                Validator.isEmail('#email'),
                Validator.isRequired('#name'),
                Validator.isPhoneNum('#phone'),
            ]
        })
    </script>
    <style>
        span{
            color:red
        }
    </style>
@stop
