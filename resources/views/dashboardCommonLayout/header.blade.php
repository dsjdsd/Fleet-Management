<!doctype html>
<html class="no-js " lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Fleet Management System | Logistic Unit :: Dashboard</title>
        <link rel="icon" href="{{ asset('dashboard-assets/favicon/favicon.png') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('dashboard-assets/plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard-assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('dashboard-assets/plugins/charts-c3/plugin.css') }}"/>
        <link rel="stylesheet" href="{{ asset('dashboard-assets/plugins/morrisjs/morris.min.css') }}"/>

        <!-- Custom Css -->
        <link rel="stylesheet" href="{{ asset('dashboard-assets/css/style.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard-assets/css/dashboard_common.css') }}">
        <script src="https://kit.fontawesome.com/e142f18144.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('dashboard-assets/plugins/charts-c3/plugin.css') }}"/>
        <link rel="stylesheet" href="{{ asset('dashboard-assets/plugins/dropify/css/dropify.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard-assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="{{ asset('dashboard-assets//plugins/select2/select2.css')}}" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" defer></script>
        <script src="{{ asset('dashboard-assets/js/sweetalert.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
       
    </head>
    <body class="theme-blush">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img class="zmdi-hc" src="{{ asset('dashboard-assets/logo/up_police_logo.png') }}" width="100" height="100" alt=""></div>
                <p>Please wait...</p>
            </div>
        </div>

        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>

        <!-- Right Icon menu Sidebar -->
        <div class="navbar-right">
            <ul class="navbar-nav">
                <li><a href="{{ route('user_profile') }}" class="main_search" title="Profile"><i class="zmdi zmdi-account"></i></a></li>
                <li><a href="{{ route('notification') }}" class="main_search" title="Notifications"><i class="zmdi zmdi-notifications"></i></a></li>
                <li><a href="{{route('logout')}}" class="mega-menu" title="Sign Out"><i class="zmdi zmdi-power"></i></a></li>
            </ul>
        </div>
