@extends("teacher.layouts.app")
@section("content")

<div class="form-row mb-5 frm-dashboard-block">
    <div class="user-dashboard-table table-responsive">
        <form action="{{url('/teacher/password/change-confirm')}}" method="post" id="pass_change_frm">
            @csrf
            <div class="form-group">
                <label for="password" class="font-weight-bold">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter current password">
                <span class="form-message"> </span>
            </div>

            <div class="form-group">
                <label for="newpass" class="font-weight-bold">New password</label>
                <input type="password" class="form-control" name="newpassword" id="newpass" placeholder="Enter new password">
                <span class="form-message"> </span>
            </div>

            <div class="form-group">
                <label for="confirm" class="font-weight-bold">Confirm password</label>
         
                    <input type="password" class="form-control btnPassword" name="confirmpassword" id="confirm" placeholder="Enter new password again!">         
                    <span class="form-message"> </span>
            </div>

            <div class="containter col-md-12 mb-4">
               <input type="submit" value="SUBMIT" class="btn btn-primary btn-lg ">
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('/js/validator.js') }}"></script>
    <script>
        Validator({
            form: '#pass_change_frm',
            rules: [
                Validator.minLength('#newpass',6),
                Validator.isConfirmed('#confirm',function(){
                    return $('#pass_change_frm #newpass').val()
                }),
            ]
        })
    </script>
<script>
    // const ipnElement = document.querySelector('#confirm')
    // const btnElement = document.querySelector('#btnPassword')
    // btnElement.addEventListener('click', function() {

    // const currentType = ipnElement.getAttribute('type')
    // ipnElement.setAttribute(
    //     'type',
    //     currentType === 'password' ? 'text' : 'password'
    // )
    // })


    $('.icon').mousedown(function () {
        $('.btnPassword').attr('type', 'text');
    });
    $('.icon').mouseup(function () {
        $('.btnPassword').attr('type', 'password');
    });




</script>
@stop
