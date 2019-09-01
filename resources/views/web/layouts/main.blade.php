<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ mix('web/assets/css/web.css') }}">
{{--    <script type="text/javascript" src="{{ mix('web/assets/js/app.js') }}"></script>--}}
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
