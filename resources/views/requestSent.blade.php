@extends('layouts.main')

@section('body')
<div id="header">
<div class="wrapper">
<div id="logo"><a href="{{ url('/home') }}"><img src="/images/logo.png" width="265" height="70"></a></div>

</div>
</div>
<div id="loginbanner">

</div>

<div class="wrapper">
  <div id="loginwrapper">
  <img width="256" vspace="20" height="256" src="/images/inviteicon.png">
<h2>Thanks for your interest!</h2>
Leave us your information and we'll send you an invite as soon as we're ready.
  <div style="height:20px;"></div>
  
    
  </div>
</div>


@endsection
