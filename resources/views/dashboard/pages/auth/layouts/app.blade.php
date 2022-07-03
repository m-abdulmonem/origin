<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ get_title() }}</title>
    {{-- @lang(isset($title) ?  $title . " | " : "")AdminLTE --}}
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ admin_assets('all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ admin_assets('icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ admin_assets('adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        {{-- <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div> --}}
        @yield('content')
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ admin_assets('jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ admin_assets('bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ admin_assets('adminlte.min.js') }}"></script>
</body>

</html>
