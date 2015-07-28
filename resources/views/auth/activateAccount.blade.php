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
  <img width="256" vspace="20" height="256" src="/images/loginicon.png">

    <p>To get started, check your email inbox for an email from us with the subject: 
    "Account Verification Email". Just click the link in this email to verify your account.</p>

    <p>If you did not receive an account verification email from us to the email address 
    you used to sign up, check your spam folder in your email account, or press the button
     below to Resend the Verification Email</p>

    <a href='/resendEmail'>{{ Lang::get('auth.clickHereResend') }}</a>
   </div>
</div>
@endsection