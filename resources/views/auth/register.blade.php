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

<h2>Register</h2>
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
  <div style="height:20px;"></div>
  
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
      <input type="text"     class="loginformfield" value="" placeholder="Your Name" id="name"  name="name" required>
      <input type="email"    class="loginformfield" value="" placeholder="Your Email" id="email"  name="email" required > 
      <input type="password" class="loginformfield" value="" placeholder="Your Password" id="password"  name="password" required>
      <input type="password" class="loginformfield" value="" placeholder="Confirm Password"   name="password_confirmation" required>
      
      <input type="image" src="/images/btn_invite.png" id="imageField" name="submit">
    </form>
    
  </div>
</div>


@endsection
