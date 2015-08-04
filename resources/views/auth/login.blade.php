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
<h2>Welcome back</h2>
    @if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="text" value="" placeholder="Your Email" id="email" class="loginformfield" name="email">
      
      <input type="password" value="" placeholder="Your Password" id="password" class="loginformfield" name="password" kl_virtual_keyboard_secure_input="on">
      <!-- <div class="checkbox">
			<label>
				<input type="checkbox" name="remember"> Remember Me
			</label>
		</div>-->
      <input type="image" src="/images/btn_login.png" id="imageField" name="imageField">
    </form>
    <br>
    <a href="{{ url('/password/email') }}">Forgot Password</a><br>
<br>
<b><a href="{{ url('/request') }}">New? Signup Today</a></b></div>
</div>


@endsection
