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

      <!-- TIP -->
      @if(\Session::has('message'))
        <div class="alert alert-success alert-dismissable collapse in" id="sessionMessage">
          <button type="button" class="close" data-toggle="collapse" data-target="#sessionMessage" aria-hidden="true">&times;</button>
          <div>{{ Session::get('message') }}</div>
        </div>
      @endif

      @yield('content')

     </div>
  </div>
@endsection
