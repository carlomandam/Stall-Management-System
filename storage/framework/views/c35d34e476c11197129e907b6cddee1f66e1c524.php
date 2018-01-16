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

        .loadingDiv {
            display:    none;
            position:   fixed;
            z-index:    1000000000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 ) 
                        url('<?php echo e(URL::asset('image/FhHRx.gif')); ?>') 
                        50% 50% 
                        no-repeat;
        }

        body.loading {
            overflow: hidden;   
        }

        .btn-glyphicon { 
            padding:8px;
            background:#ffffff;
            margin-right:4px;
        }
        
        .icon-btn { 
            padding: 1px 15px 3px 2px;
            border-radius:50px;
        }

        /* Anytime the body has the loading class, our
           modal element will be visible */
        body.loading .modal {
            display: block;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini" style="height:auto;min-height:100%;" onload = "myTimer();">
    <div class="wrapper" style="overflow:hidden;">
        <header class="main-header">
            <a href="/" class="logo"> <span class="logo-mini"><b>M</b>SA</span> <span class="logo-lg"><b>MySeoul </b></span> </a>
            <nav class="navbar navbar-fixed-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a> <span class="system-name"><b>Stalls Management System</b></span>
                <ul class="nav navbar-nav navbar-right">                    
                    <li class="dropdown" style="margin-right: 10px;"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        
                        <span><?php echo e(Auth::user()->fname.' '.Auth::user()->lname); ?></span><span class="caret"></span> </a>
                        <ul class="dropdown-menu" role="menu">
                            <li> <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            </form>
                            </li>
                            <li>
                                <a href="/addUsers">Update Account Info</a> 
                            </li>
                        </ul>
                    </li>
                </ul>
                <p id = "time"><small class = "system-time pull-right" ></small></p>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image"> <img src="<?php echo e(URL::asset('image/userimage2.png')); ?>" class="img-circle" alt="User Image"> </div>
                    <div class="pull-left info">
                        <p id="userName"><?php echo e(Auth::user()->fname.Auth::user()->lname); ?></p>
                        <p id="position" style="font-size: 11px;font-weight: normal;"><?php echo e(Auth::user()->position); ?></p>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="header"><span>MAIN NAVIGATION</span></li>
                    <li class="treeview <?php echo e(Route::getFacadeRoot()->current()->uri() == 'Dashboard' ? 'active' : ''); ?>" >
                        <a href="/" > <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
                    </li>
                    <li class="treeview">
                        <a href="#"> <i class="fa fa-tasks"></i> <span>Transactions</span> <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i> 
                                </span> </a>
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <a href="/StallHolderList"> <i class="fa fa-circle-o"></i> <span>Manage Contracts</span> </a>
                            </li>
                            <li class="treeview">
                                <a href="#"> <i class="fa fa-circle-o"></i> <span>Billing and Collections</span> <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i> 
                                </span> </a>
                                <ul class="treeview-menu">
                                    <li id="">
                                        <a href="<?php echo e(url('/Utilities')); ?>"> <i class="fa fa-circle-o"></i><span>Utilities</span></a>
                                    </li>
                                    <li id="">
                                        <a href="<?php echo e(url('/Billing')); ?>"> <i class="fa fa-circle-o"></i><span>Billing</span></a>
                                    </li>
                                    <li id="">
                                        <a href="<?php echo e(url('/Payment')); ?>"> <i class="fa fa-circle-o"></i><span>Payment</span></a>
                                    </li>
                                </ul>
                                <li class="treeview">
                                    <a href="/Requests"> <i class="fa fa-circle-o"></i> <span>Manage Requests</span> </a>
                                </li>
                        </ul>
                        </li>
                        <?php if(Auth::user()->position == "Admin"): ?>
                        <li class="treeview">
                            <a href="#"> <i class="fa fa-gear"></i> <span>Maintenance</span> <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i> 
                                </span> </a>
                            <ul class="treeview-menu">
                                <li> <a href="/Building"><i class="fa fa-building"></i> <span>Building</span></a> </li>
                                <li class="<?php echo e(Route::getFacadeRoot()->current()->uri() == 'StallType' || Route::getFacadeRoot()->current()->uri() == 'StallTypeArchive' ? 'active' : ''); ?>"> <a href="/StallType"><i class="fa fa-link"></i> <span>Stall Type</span></a> </li>
                                <li class="<?php echo e(Route::getFacadeRoot()->current()->uri() == 'Stall' || Route::getFacadeRoot()->current()->uri() == 'StallArchive' ? 'active' : ''); ?>"> <a href="/Stall"><i class="fa fa-link"></i> <span>Stall</span></a> </li>
                                <li class="<?php echo e(Route::getFacadeRoot()->current()->uri() == 'StallRate' || Route::getFacadeRoot()->current()->uri() == 'StallRateArchive' ? 'active' : ''); ?>"> <a href="/StallRate"><i class="fa fa-money"></i> <span>Stall Rates</span></a> </li>
                                <li class="<?php echo e(Route::getFacadeRoot()->current()->uri() == 'Charges' ? 'active' : ''); ?>"> <a href="/Charges"><i class="fa fa-file-o"></i> <span>Charges</span></a> </li>
                                <li id="mReq">
                                    <a href="<?php echo e(url('/requirements')); ?>"> <i class="fa fa-list"></i><span>Requirements</span></a>
                                </li>
                                <li id="mReq">
                                    <a href="<?php echo e(url('/Holiday')); ?>"> <i class="fa fa-calendar"></i><span>Holidays</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="/Queries"> <i class="fa fa-circle"></i> <span>Queries</span> </a>
                        </li>
                        <li class="treeview">
                            <a href="#"> <i class="fa fa-cogs"></i> <span>Utilities</span> <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i> 
                                </span> </a>
                            <ul class="treeview-menu">
                              
                                <li id="uDays">
                                    <a href="<?php echo e(url('/MarketDays')); ?>"> <i class="fa fa-calendar-times-o"></i><span>Market Days</span></a>
                                </li>
                                <li id="">
                                    <a href="<?php echo e(url('/PeakDays')); ?>"> <i class="fa fa-credit-card"></i><span>Peak Days</span></a>
                                </li>
                                <li id="">
                                    <a href="<?php echo e(url('/CollectionStatus')); ?>"> <i class="fa fa-bell"></i><span>Collection Status</span></a>
                                </li>
                                <li id="">
                                    <a href="<?php echo e(url('/InitialFee')); ?>"> <i class="fa fa-credit-card"></i><span>Initial Fee</span></a>
                                </li>
                            </ul>
                        </li>
                      
                        <?php endif; ?>
                          <li class="treeview">
                            <a href="#"> <i class="fa fa-bar-chart"></i> <span>Reports</span> <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i> 
                                </span> </a>
                            <ul class="treeview-menu">
                                <li ><a href="/BalanceSummary"><i class="fa fa-circle-o "></i>Balance Summary</a></li>
                                <li><a href="/StatusListReport"><i class="fa fa-circle-o"></i>Status List Report</a></li>
                              
                                <li><a href = "/PaymentsCollectedReport"><i class="fa fa-circle-o"></i>Payments Collected Report</a></li>
                            </ul>
                        </li>
                        <?php if(Auth::user()->position == "Admin"): ?>
                        <li class="treeview">
                            <a href="/NewUser"> <i class="glyphicon glyphicon-user"></i> <span>System Users</span> </a>
                        </li>
                        <li class="treeview">
                            <a href="/BackupandRecovery"> <i class="fa fa-undo"></i> <span>Backup and Recovery</span> </a>
                        </li>
                        <?php endif; ?>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            <section class="content-header"> <?php echo $__env->yieldContent('content-header'); ?> </section>
            <section class="content"> <?php echo $__env->yieldContent('content'); ?> </section>
        </div>
    </div>
    <div class="modal loadingDiv"></div>
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
    <script>
        $body = $("body");

        $(document).on({
             ajaxStop: function() { $body.removeClass("loading"); }    
        });

        setInterval(myTimer, 1000);
        $.widget.bridge('uibutton', $.ui.button);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = window.location;
        // for treeview
        $('ul.treeview-menu a').filter(function () {
            return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
        $('ul.sidebar-menu a').filter(function () {
            return this.href == url;
        }).parent().addClass('active');

        function myTimer() {
            var d = new Date();

            var days = new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
            var months = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
            var date = ((d.getDate()<10) ? "0" : "")+ d.getDate();
            function fourdigits(number) {
                return (number < 1000) ? number + 1900 : number;
            }
            today =  days[d.getDay()] + ", " +
            months[d.getMonth()] + " " +
            date + ", " +
            (fourdigits(d.getYear())) ;
            $('#time small').text(today +" "+d.toLocaleTimeString());
           
            } 
    </script> <?php echo $__env->yieldContent('script'); ?> </body>

</html>