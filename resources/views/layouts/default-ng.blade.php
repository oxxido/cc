<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body ng-app="app" ng-controller="mainController">
  @yield('body')
  @include('includes.footer')
</body>
</html>