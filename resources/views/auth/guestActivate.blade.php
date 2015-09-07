@extends('auth.layout')

@section('content')
  <h2>Activate your account</h2>
  <div class="panel-body">
    <p>An email was sent to {{ $email }} on {{ $date }}.</p>
    <p>{{ Lang::get('auth.clickInEmail') }}</p>
    <p><a href='/auth/resend'>{{ Lang::get('auth.clickHereResend') }}</a></p>
  </div>
@endsection