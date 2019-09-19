<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Compiled Mix CSS --}}
    <link rel="stylesheet" href="{{ asset(mix('admin/assets/css/admin.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('admin/assets/css/styles.css')) }}">
    <!-- Compiled Mix JS -->
    <script type="text/javascript" src="{{ asset(mix('admin/assets/js/scripts.js')) }}"></script>

    @include('adminlte::plugins', ['type' => 'css'])

    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

@include('adminlte::plugins', ['type' => 'js'])

@yield('adminlte_js')

</body>
</html>
