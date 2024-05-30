@extends('administrator.layouts.app')
@section('content')

<h3 class="mb-3 mt-4">Create Teacher Account </h3>
    <div class="card">
        <div class="card-body">
            
            <form id="create-form" action="{{ url('/administrator/teacher-store') }}" method="post">
                {!! csrf_field() !!}
                <div class="container">
                    <div class="row">
                        <!-- Col 06 -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name"> Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                                <span class="form-message"> </span>
                            </div>
                        </div>


                        <!-- Col 06 -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="abcdef@website.com">
                                <span class="form-message"> </span>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input id="phone" type="text" name="phone" class="form-control"
                                    placeholder="000-000-0000">
                                <span class="form-message"> </span>
                            </div>
                        </div>



                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="inputPassword" class="form-control"
                                    placeholder="******">
                            </div>
                            <span class="form-message"> </span>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">

                                <label for="">Male</label>
                                <input type="radio" name="gender" value=1>
                                <label class="ml-5" for="">Female</label>
                                <input type="radio" name="gender" value=0>
                            </div>
                            <span class="form-message"> </span>

                        </div>

                        <div class="row">
                            <div class="">
                                <a class="btn btn-secondary" style="color:white; text-decoration:none"
                                    href="{{ url('/administrator/teacher-list') }}">Back</a>
                            </div>
                            <div class="ml-3">
                                <input type="submit" value="Save" class="btn btn-success">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('/js/validator.js') }}"></script>
    <script>
        Validator({
            form: '#create-form',
            rules: [
                Validator.isEmail('#email'),
                Validator.isRequired('#name'),
                Validator.isPhoneNum('#phone'),
            ]
        })
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.card-header').prop('hidden', true);
        });
    </script>
    <style>
        span {
            color: red
        }
    </style>
@stop
