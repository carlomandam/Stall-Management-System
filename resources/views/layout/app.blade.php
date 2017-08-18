<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MySeoul | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/dist/css/skins/skin-blue.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/select2/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datepicker/datepicker3.css')}}">
    @yield('style')
    <style>
	    *{
	    	font-family: "Trebuchet MS"
	    }
        .modal-header {
            background-color: dodgerblue;
            color: aliceblue;
        }
        
        .table-responsive {
            overflow: visible !important;

        }
        
        .error-class {
            color: red;
            border-color: 2px solid #ebccd1;
            padding: 1px 20px 1px 20px;
        }
        .main-header{
            position: fixed;
        }
        .content-header {
            margin-top: 40px;
        }
        
        .content {
            margin-top: 20px;
        }
        .defaultNewButton{
            margin-left:5px;
            margin-top:10px;
            margin-bottom: 10px;
        }
        #archive{
            margin-right:20px;
        }
        .required {
            color: red;
        } 

        .box-header-label
        {
          font-size: 18px;
        }

    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini" style="height:auto;min-height:100%;">
    <div class="wrapper" style="overflow:hidden;">
        <header class="main-header">
            <a href="index2.html" class="logo">
                <span class="logo-mini"><b>M</b>SA</span>
                <span class="logo-lg"><b>MySeoul </b>Admin</span> 
              </a>
            <nav class="navbar navbar-fixed-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
                <div class="navbar-custom-menu">
                    <!-- For LOg OUT -->
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image"> <img src="image/JohnAlfred.jpg" class="img-circle" alt="User Image"> </div>
                    <div class="pull-left info">
                        <p id = "userName">John Alfred C. Clave</p>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="header"><span>MAIN NAVIGATION</span></li>
                	 <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                        <li class = "treeview">    
                              <a href="#"> 
                              <i class="fa fa-tasks"></i> <span>Transactions</span>
                               <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i> 
                                </span> 
                              </a> 

                              <ul class="treeview-menu">
                                     <li class = "treeview">
                                        <a href="/StallHolderList">
                                        <i class="fa fa-circle-o"></i> <span>Manage Contracts</span>
                                        </a>
                                    </li>

                             
                                      <li class="treeview"> 
                                        <a href="#">
                                        <i class="fa fa-circle-o"></i><span>Payment and Collections</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i> 
                                        </span> 
                                        </a>

                                         <ul class="treeview-menu">
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Billing</a></li>
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Payment</a></li>
                                        </ul>

                                      </li>
                            
                                    <li class = "treeview">
                                        <a href="#">
                                        <i class="fa fa-circle-o"></i> <span>Manage Requests</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i> 
                                        </span> 
                                        </a>

                                        <ul class="treeview-menu">
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Request List</a></li>

                                        </ul>
                                    </li>
                              </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"> 
                              <i class="fa fa-gear"></i> <span>Maintenance</span>
                               <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i> 
                                </span> 
                            </a> 
                            <ul class="treeview-menu">
                                     <li><a href="/Building"><i class="fa fa-building"></i> <span>Building</span></a></li>
                                    <li class="{{Route::getFacadeRoot()->current()->uri() == 'StallType' || Route::getFacadeRoot()->current()->uri() == 'StallTypeArchive' ? 'active' : ''}}"><a href="/StallType"><i class="fa fa-link"></i> <span>Stall Type</span></a></li>
                                    <li class="{{Route::getFacadeRoot()->current()->uri() == 'Stall' || Route::getFacadeRoot()->current()->uri() == 'StallArchive' ? 'active' : ''}}"><a href="/Stall"><i class="fa fa-link"></i> <span>Stall</span></a></li>
                                   <li class="{{Route::getFacadeRoot()->current()->uri() == 'StallRate' || Route::getFacadeRoot()->current()->uri() == 'StallRateArchive' ? 'active' : ''}}"><a href="/StallRate"><i class="fa fa-money"></i> <span>Stall Rates</span></a></li>
                                    <li id="mKiosk"><a href="/kioskmap"><i class="fa fa-map"></i><span>Kiosk Map</span></a></li>
                                    <li class="{{Route::getFacadeRoot()->current()->uri() == 'Fee' ? 'active' : ''}}"><a href="/Fee"><i class="fa fa-file-o"></i> <span>Fees</span></a></li>
                                              </ul>
                        </li>

                         <li class = "treeview">    
                              <a href="/Queries"> 
                              <i class="fa fa-circle"></i> <span>Queries</span>
                              <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i> 
                              </span> 
                              </a> 

                        </li>

                         <li class = "treeview">    
                              <a href="#"> 
                              <i class="fa fa-cogs"></i> <span>Utilities</span>
                               <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i> 
                                </span> 
                              </a> 
                              <ul class="treeview-menu">
                                    <li class = "active"><a href="#"><i class="fa fa-building-o "></i> Vendor Collection Status</a></li>
                              </ul>
                        </li>

                        <li class = "treeview">    
                              <a href="#"> 
                              <i class="fa fa-bar-chart"></i> <span>Reports</span>
                               <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i> 
                                </span> 
                              </a>

                              <ul class="treeview-menu">
                                      <li class = "active"><a href="#"><i class="fa fa-circle-o "></i>Receivables Report</a></li>
                                         <li><a href="#"><i class="fa fa-circle-o"></i>Stall Status Report</a></li>
                              </ul>
                        </li>
                   
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            <section class="content-header">
             @yield('content-header')
            </section>
            <!-- Main content -->
            <section class="content">
             @yield('content')
              </section>
            <!-- /.content -->
        </div>
          
    </div>

        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
      
     
    

    <!-- ./wrapper -->
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
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script type="text/javascript">
      /** add active class and stay opened when selected */
var url = window.location;


// for treeview
$('ul.treeview-menu a').filter(function() {
     return this.href == url;
}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');



    </script>
    
    @yield('script') 
    </body>

</html>