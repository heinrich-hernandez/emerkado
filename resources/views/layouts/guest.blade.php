<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'eMerkado') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="{{ asset('css/google_fonts_source_sans_pro.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css ') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
</head>
@yield('content')
<!-- /.login-box -->

<!-- Bootstrap 5 -->
<!-- AdminLTE App -->

<script src="{{ asset('js/jquery.min.js') }}" ></script>
<script src="{{ asset('js/jquery-ui.min.js') }}" defer></script>
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>
<script src="{{ asset('js/jquery.validate.min.js') }}" defer></script>
<script src="{{ asset('js/bootstrap.js') }}" ></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.min.js') }}" defer></script>
<script src="{{ asset('js/toastr.min.js') }}" defer></script> 
<script src="{{ asset('js/form_validation.js') }}" defer></script>
<script src="{{ asset('js/ajax_functions.js') }}" defer></script>
<script src="{{ asset('js/bootstrap-toggle.min.js') }}"  defer></script>
<script src="{{ asset('js/summernote.min.js') }}" defer></script>
<script src="{{ asset('js/summernote-bs4.min.js') }}" defer></script>
<script src="{{ asset('js/custom_functions.js') }}" defer></script>
</body>
</html>
