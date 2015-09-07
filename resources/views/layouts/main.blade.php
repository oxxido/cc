<!doctype html>
<html>
<head>
    @include('includes.head')
    @yield('head')
</head>
<body>
    @yield('header')
    @yield('body')
    @include('includes.footer')
    @yield('footer')
</body>
</html>
