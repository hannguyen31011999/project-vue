<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Plugins css-->
    <link href="{{ asset('/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">

    <!-- App css -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
    <link href="{{ asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet">

    <!-- third party css -->
    <link href="{{ asset('/assets/libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
   
    <!-- laravel mix -->
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    @yield('css')
</head>
<body>
    @yield('content')
    
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

    <!-- Vendor js -->
    <!-- <script src="{{ asset('/assets/css/app-dark.min.css') }}"></script> -->

    <!-- <script src="{{ asset('/assets/libs/moment/moment.min.js') }}"></script> -->
    <!-- <script src="{{ asset('/assets/libs/jquery-scrollto/jquery.scrollTo.min.js') }}"></script> -->
    <!-- <script src="{{ asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script> -->

    <!-- Chat app -->
    <!-- <script src="{{ asset('/assets/js/pages/jquery.chat.js') }}"></script> -->

    <!-- Todo app -->
    <!-- <script src="{{ asset('/assets/js/pages/jquery.todo.js') }}"></script> -->

    <!--Morris Chart-->
    <!-- <script src="{{ asset('/assets/libs/morris-js/morris.min.js') }}"></script> -->
    <!-- <script src="{{ asset('/assets/libs/raphael/raphael.min.js') }}"></script> -->

    <!-- Sparkline charts -->
    <!-- <script src="{{ asset('/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script> -->

    <!-- Dashboard init JS -->
    <!-- <script src="{{ asset('/assets/js/pages/dashboard.init.js') }}"></script> -->

    <!-- App js -->
    <script src="{{ asset('/assets/js/app.min.js') }}"></script>
    <script src="{{asset('/ckeditor/ckeditor.js') }}"></script>
    <script src="{{asset('/ckfinder/ckfinder.js') }}"></script>
    @yield('js')
</body>
</html>