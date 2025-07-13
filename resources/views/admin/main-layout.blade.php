<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel {{ isset($title) ? '| ' . $title : '' }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}"> <!-- optimized file, please refer the readable css on template file -->
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}"><!-- optimized file, please refer the readable css on template file -->
    <link rel="stylesheet" href="{{ asset('css/summernote-bs4.min.css') }}"><!-- optimized file, please refer the readable css on template file -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-toggle.min.css') }}">
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                        <a href="#" class="dropdown-item">
                            <i class="mr-2 fas fa-file"></i>
                            {{ __('My profile') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('Logout') }}">
                            @csrf
                            <a href="{{ route('Logout') }}" class="dropdown-item"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="mr-2 fas fa-sign-out-alt"></i>
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.layout.left-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    @vite('resources/js/app.js')
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}" defer></script>
    <script src="{{ asset('js/custom_functions.js') }}" defer></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}" defer></script> <!-- optimized file, please refer the readable css on template file -->
    <script src="{{ asset('js/toastr.min.js') }}" defer></script> <!-- optimized file, please refer the readable css on template file -->
    <script src="{{ asset('js/form_validation.js') }}" defer></script>
    <script src="{{ asset('js/ajax_functions.js') }}" defer></script>
    <script src="{{ asset('js/summernote-bs4.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-toggle.min.js') }}"  defer></script>
    @yield('scripts')
    @stack('scripts')
</body>

@if (request()->query('status') === 'success')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showSuccess(
                "Success! A new record was added."
            ); //SHOW SUCCESS MESSAGE VIA TOASTER.JS
        });
    </script>
@elseif (request()->query('status') === 'error' && request()->query('user_id'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showError(
                "Record creation failed."
            ); //SHOW ERROR MESSAGE VIA TOASTER.JS
        });
    </script>
@elseif (request()->query('status') === 'approved_account')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showSuccess(
                "Approved Account."
            ); //SHOW ERROR MESSAGE VIA TOASTER.JS
        });
    </script>
@elseif (request()->query('status') === 'denied_account')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showWarning(
                "Submitted for client for compliance."
            ); //SHOW ERROR MESSAGE VIA TOASTER.JS
        });
    </script>
@endif

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showError('Error processing merchant record.'); //SHOW WARNING MESSAGE VIA TOASTER.JS
        });
    </script>
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</html>
