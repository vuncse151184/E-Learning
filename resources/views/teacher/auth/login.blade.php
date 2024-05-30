@extends('teacher.layouts.login_teacher')
@section('content')
    <div class="container">
        <form class="form-login" method="POST" action="{{url('/teacher/login')}}">
            @csrf
            <img class="mb-4" src="../assets/assets/img/login-logo.png" alt="">
            <h3>Login</h3>
            <div class="row mb-4">
                <label for="inputEmail">Email Address</label>
                <input type="email" id="inputEmail" name="email" class="form-control" required="" autofocus="">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <small class="text-error text-danger">Please enter your e-mail address.</small>
            </div>
            <div class="row mb-5">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" required="">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message}}</strong>
                    </span>
                @enderror
                <small class="text-error text-danger">Please enter your password.</small>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button> <a href="#!" title="パスワードを忘れた方はこちら">If you forgot your password, click here</a>
        </form>
    </div>

@stop
