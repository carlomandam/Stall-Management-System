<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MySeoul | <?php echo $__env->yieldContent('title'); ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/datatables/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/dist/css/AdminLTE.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/dist/css/skins/skin-blue.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/datatables/toastr.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/select2/select2.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/datepicker/datepicker3.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('css/dropdown.css')); ?>"> <?php echo $__env->yieldContent('style'); ?>
    <style>
        * {
            font-family: "Trebuchet MS"
        }
        
        .fa-power-off {
            margin-right: 20px;
        }
        
        .modal-header {
            background-color: dodgerblue;
            color: aliceblue;
        }
        
        .table-responsive {
            overflow: visible !important;
        }
        
        .error-class {
            color: red !important;
            border-color: 2px solid #ebccd1;
            padding: 1px 20px 1px 20px;
        }
        
        li.error-class {
            color: white !important;
            border-color: 2px solid #ebccd1;
            padding: 1px 20px 1px 20px;
        }
        
        .main-header {
            position: fixed;
        }
        
        .content-header {
            margin-top: 40px;
        }
        
        .content {
            margin-top: 20px;
        }
        
        .defaultNewButton {
            margin-left: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        
        #archive {
            margin-right: 20px;
        }
        
        .required {
            color: red;
        }
        
        .box-header-label {
            font-size: 18px;
        }
        
        .system-name{
            font-size: 20px;
            color: white;
            margin-left: 30px;
            position: relative;
            top: 10px;
        }
        .system-time {
            font-size: 14px;
            color: white;
            position: relative;
            bottom: 12px;
           

        }
        
        .select2-selection__choice {
            color: black !important;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div style="align-content: center;">
        <h3><b>My Seoul Goods and Garments</b></h3>
    </div>
    
    <script src="<?php echo e(URL::asset('assets/jQuery/jquery-2.2.3.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/dist/js/app.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/jQueryUI/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/jQueryUI/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/jQuery/jquery.validate.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/datatables/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/datatables/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/select2.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    </script> <?php echo $__env->yieldContent('script'); ?>
</body>

</html>