<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MySeoul | Log In</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/dist/css/skins/skin-blue.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/select2/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datepicker/datepicker3.css')}}">
       <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/dropdown.css')}}">

    @yield('style')
 
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>MySeoul Log In</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in</p>

    <form action="../../index2.html" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

  <script src ="{{ URL::asset('assets/jQuery/jquery-2.2.3.min.js')}}"></script>
    <script src ="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/dist/js/app.min.js')}}"></script>
    <script src="{{ URL::asset('assets/jQueryUI/jquery-ui.min.js')}}"></script>
    <script src="{{ URL::asset('assets/jQueryUI/jquery-ui.min.js')}}"></script>
    <script src="{{ URL::asset('assets/jQuery/jquery.validate.js')}}"></script>
    <script src="{{ URL::asset('assets/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{ URL::asset('assets/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/datatables/toastr.min.js')}}"></script>
    <script src="{{ URL::asset('js/select2.js')}}"></script>
    <script src ="{{ URL::asset('assets/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ URL::asset('js/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>