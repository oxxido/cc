<!doctype html>
<html>
<head>
    @include('includes.admin.head')
    @yield('head')
    <meta name="_token" content="{{ csrf_token() }}">
</head>
<body class="skin-green fixed sidebar-mini">
    @yield('body')
    @include('includes.admin.footer')
    @yield('footer')
</body>
</html>
