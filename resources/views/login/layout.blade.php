<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Stalls Management System | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/login.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/font-awesome/css/font-awesome.min.css')}}">

</head>

<body class="hold-transition skin-blue sidebar-mini" style="height:auto;min-height:100%; ">
    @yield('content')
    <script src="{{ URL::asset('assets/jQuery/jquery-2.2.3.min.js')}}"></script>
    <script src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!-- <script type="text/javascript" src="{{ URL::asset('js/login.js') }}"></script> -->
</body>

</html>