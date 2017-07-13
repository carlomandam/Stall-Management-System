<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MySeoul Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.foundation.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.jqueryui.css">
    <link rel="stylesheet" type="text/css" href="css/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="css/select2.css">
    <link rel="stylesheet" type="text/css" href="css/select2.min.css">
    <link rel="stylesheet" type="text/css" href = "datepicker/datepicker3.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <style>
        .modal-header{
            background-color: dodgerblue;
            color: aliceblue;
        }
        .table-responsive{
            overflow: visible !important;
        }

        .error-class {
  color: #a94442;
  border-color: 2px solid #ebccd1;
  padding:1px 20px 1px 20px;
}
.main-sidebar,.main-header{
  position: fixed;
}
.content-header{
  margin-top: 40px;
}
.content{
  margin-top: 20px;
}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>SA</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>My Seoul</b>Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-fixed-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <!-- For LOg OUT -->
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="image/JohnAlfred.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>John Alfred C. Clave</p>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

        <li class="header" style="font-size: 15px;">Transaction</li>
       
         
            <li class = "{{Route::getFacadeRoot()->current()->uri() == 'Registration' ? 'active' : ''}}"><a href="/Registration"><i class="fa fa-pencil-square"></i> Registration</a></li>
            <li class = "{{Route::getFacadeRoot()->current()->uri() == 'List' ? 'active' : ''}}"><a href="/List"><i class="fa fa-list-alt"></i>Stall Holders</a></li>
    
        </li>
       
            <li class = "{{Route::getFacadeRoot()->current()->uri() == 'Contract' ? 'active' : ''}}"><a href="/Contract"><i class="glyphicon glyphicon-modal-window "></i>Contracts</a></li>
         

        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Stall Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Process Payments and Collection</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Request Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>

         <li class="header" style="font-size: 15px;">Maintenance</li>
            <li class = "{{Route::getFacadeRoot()->current()->uri() == 'Building' ? 'active' : ''}}"><a href="/Building"><i class="fa fa-building"></i> <span>Building</span></a></li>
            <li class = "{{Route::getFacadeRoot()->current()->uri() == 'StallType' ? 'active' : ''}}"><a href="/StallType"><i class="fa fa-link"></i> <span>Stall Type</span></a></li>
            <li class = "{{Route::getFacadeRoot()->current()->uri() == 'Stall' ? 'active' : ''}}"><a href="/Stall"><i class="fa fa-link"></i> <span>Stall</span></a></li>
            <li class = "{{Route::getFacadeRoot()->current()->uri() == 'StallRate' ? 'active' : ''}}"><a href="/StallRate"><i class="fa fa-money"></i> <span>Stall Rates</span></a></li>
            <li class = "{{Route::getFacadeRoot()->current()->uri() == 'Fee' ? 'active' : ''}}"><a href="/Fee"><i class="fa fa-file-o"></i> <span>Fees</span></a></li>
            <li class = "{{Route::getFacadeRoot()->current()->uri() == 'Penalty' ? 'active' : ''}}"><a href="/Penalty"><i class="fa fa-link"></i> <span>Penalties</span></a></li>
            <li class = "{{Route::getFacadeRoot()->current()->uri() == 'Utility' ? 'active' : ''}}"><a href="/Utility"><i class="fa fa-link"></i> <span>Utilities</span></a></li>        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      @yield('content-header')
      <!-- <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="datatables/jquery.dataTables.js"></script>
<script src="datatables/dataTables.bootstrap.min.js"></script>
<script src="datatables/dataTables.foundation.js"></script>
<script src="datatables/dataTables.jqueryui.js"></script>
<script src="datatables/dataTables.select.min.js"></script>
<script src="datatables/toastr.min.js"></script>
<script src="datatables/jquery.validate.js"></script>
<script src="js/lodash.core.js"></script>
<script>
</script>
<!--

<!-- jQuery 2.2.3 
<script src="jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="jqueryUI/jquery-ui.js"></script>
<script src="jqueryUI/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->

<script src="datepicker/bootstrap-datepicker.js"></script>
<script src="datepicker/bootstrap-datepicker.min.js"></script>
<script src="js/select2.js"></script>
<script src="js/select2.min.js"></script>
@yield('script')
</body>
</html>
