<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset(mix('web/assets/css/web.css')) }}">
    {{--    <script type="text/javascript" src="{{ asset(mix('web/assets/js/app.js')) }}"></script>--}}
</head>
<body>

@yield('content')

@stack('js')
@yield('js')

@stack('css')
@yield('css')

<script type="text/javascript" src="{{ mix('web/assets/js/scripts.js') }}"></script>

</body>
</html>
