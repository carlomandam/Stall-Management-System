<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Stalls Management System | <?php echo $__env->yieldContent('title'); ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/bootstrap/css/login.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/font-awesome/css/font-awesome.min.css')); ?>">

</head>

<body class="hold-transition skin-blue sidebar-mini" style="height:auto;min-height:100%; ">
    <?php echo $__env->yieldContent('content'); ?>
    <script src="<?php echo e(URL::asset('assets/jQuery/jquery-2.2.3.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript">
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!-- <script type="text/javascript" src="<?php echo e(URL::asset('js/login.js')); ?>"></script> -->
</body>

</html>