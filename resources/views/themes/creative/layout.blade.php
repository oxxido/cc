<!doctype html>
<html>
<head>
    @include('themes.creative.includes.head')
</head>
<body ng-app="app" ng-controller="mainController"  id="page-top">
  @yield('body')
  @include('themes.creative.includes.footer')
</body>
</html>