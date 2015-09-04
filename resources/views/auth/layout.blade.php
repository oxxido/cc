@extends('layouts.main')

@section('body')
  <div id="header">
    <div class="wrapper">
      <div id="logo"><a href="/home"><img src="/images/logo.png" width="265" height="70"></a></div>
    </div>
  </div>

  <div id="loginbanner">
  </div>

  <div class="wrapper">
    <div id="loginwrapper">

      @yield('content')

     </div>
  </div>
@endsection