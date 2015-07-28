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

    <h2>Activate your account</h2>
    <div class="panel-body">
        <p>An email was sent to {{ $email }} on {{ $date }}.</p>

        <p>{{ Lang::get('auth.clickInEmail') }}</p>
        
        <p><a href='/resendEmail'>{{ Lang::get('auth.clickHereResend') }}</a></p>
    </div>
  </div>
  </div>

@endsection