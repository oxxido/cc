@extends('auth.layout')

@section('content')
  <img width="256" vspace="20" height="256" src="/images/loginicon.png">

  <p>To get started, check your email inbox for an email from us with the subject: 
  "Account Verification Email". Just click the link in this email to verify your account.</p>

  <p>If you did not receive an account verification email from us to the email address 
  you used to sign up, check your spam folder in your email account, or press the button
  below to Resend the Verification Email</p>

  <a href='/auth/resend'>{{ Lang::get('auth.clickHereResend') }}</a>
@endsection