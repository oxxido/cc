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

                    <p>{{ Lang::get('auth.sentEmail',
                        ['email' => $email] ) }}</p>

                    <p>{{ Lang::get('auth.clickInEmail') }}</p>
   </div>
</div>
@endsection