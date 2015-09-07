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
      	<p>To keep our systems healthy and your accounts safe, we limited the amount of mail one user can send</p>
        <p>An email was sent to {{ $email }} on {{ $date }}.</p>
        <p>If you do not receive the confirmation message within a few minutes of signing up, please check your
        Spam or Bulk E-Mail folder just in case the confirmation email got delivered there instead of your
        inbox. If so, select the confirmation message and mark it Not Spam, which should allow future messages
        to get through.</p>
      </div>
    </div>
  </div>
@endsection