<!doctype html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>MySeoul Vendor Portal</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/dist/css/AdminLTE.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/font-awesome/css/font-awesome.min.css')); ?>">

    <!-- Styles -->
    <style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    @import  url(http://fonts.googleapis.com/css?family=Roboto);

    /****** LOGIN MODAL ******/
    .loginmodal-container {
      padding: 30px;
      max-width: 350px;
      width: 100% !important;
      background-color: #F7F7F7;
      margin: 0 auto;
      border-radius: 2px;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      font-family: roboto;
  }

  .loginmodal-container h1 {
      text-align: center;
      font-size: 1.8em;
      font-family: roboto;
  }

  .loginmodal-container input[type=submit] {
      width: 100%;
      display: block;
      margin-bottom: 10px;
      position: relative;
  }

  .loginmodal-container input[type=text], input[type=password] {
      height: 44px;
      font-size: 16px;
      width: 100%;
      margin-bottom: 10px;
      -webkit-appearance: none;
      background: #fff;
      border: 1px solid #d9d9d9;
      border-top: 1px solid #c0c0c0;
      /* border-radius: 2px; */
      padding: 0 8px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
  }

  .loginmodal-container input[type=text]:hover, input[type=password]:hover {
      border: 1px solid #b9b9b9;
      border-top: 1px solid #a0a0a0;
      -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
      -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
      box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  }

  .loginmodal {
      text-align: center;
      font-size: 14px;
      font-family: 'Arial', sans-serif;
      font-weight: 700;
      height: 36px;
      padding: 0 8px;
      /* border-radius: 3px; */
/* -webkit-user-select: none;
user-select: none; */
}

.loginmodal-submit {
  /* border: 1px solid #3079ed; */
  border: 0px;
  color: #fff;
  text-shadow: 0 1px rgba(0,0,0,0.1); 
  background-color: #4d90fe;
  padding: 17px 0px;
  font-family: roboto;
  font-size: 14px;
  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
}

.loginmodal-submit:hover {
  /* border: 1px solid #2f5bb7; */
  border: 0px;
  text-shadow: 0 1px rgba(0,0,0,0.3);
  background-color: #357ae8;
  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
}

.loginmodal-container a {
  text-decoration: none;
  color: #666;
  font-weight: 400;
  text-align: center;
  display: inline-block;
  opacity: 0.6;
  transition: opacity ease 0.5s;
} 

.login-help{
  font-size: 12px;
}
</style>
</head>
<body>

  <div class="log" style="margin-top: 100px;">
    <div class="loginmodal-container">
         <h1 >Stall Management System</h1><br>
        <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo e(csrf_field()); ?>


            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                <label for="email" >Username</label>

                <div class="col-md-12">
                    <input id="username" type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>" required autofocus>

                    <?php if($errors->has('username')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('username')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>            
            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                <label for="password" control-label">Password</label>

                <div class="col-md-12">
                    <input id="password" type="password" class="form-control" name="password" required>

                    <?php if($errors->has('password')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>

            <input type="submit" name="login" class="login loginmodal-submit" value="Login">
        </form>
    </div>
</div>



<script src="<?php echo e(URL::asset('assets/jQuery/jquery-2.2.3.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/bootstrap/js/bootstrap.min.js')); ?>"></script>
 <script src="<?php echo e(asset('js/app.js')); ?>"></script>
<script type="text/javascript">
    // $(document).on('click','#btnLog', function(e){
    //     e.preventDefault();
    //     $('.log').show();
    //     $('.flex-center').hide();

    // })
    //   $(document).on('click','#back', function(e){
    //     e.preventDefault();
    //     $('.log').hide();
    //     $('.flex-center').show();

    // })
</script>    
</body>
</html>
