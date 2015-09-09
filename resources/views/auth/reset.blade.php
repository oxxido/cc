@extends('auth.layout')

@section('content')

<h2>Reset Password</h2>

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

<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="token" value="{{ $token }}">

    <input type="email" class="loginformfield" value="{{ old('email') }}" placeholder="Your Email" id="email"  name="email" required > 
	<input type="password" class="loginformfield" value="" placeholder="Your Password" id="password"  name="password" required>
	<input type="password" class="loginformfield" value="" placeholder="Confirm Password"   name="password_confirmation" required>

    <input type="image" src="/images/btn_send.png" id="imageField" name="submit">
</form>

@endsection

@section('footer')
  <script type="text/javascript" src="{{ asset('/vendor/pwstrength-bootstrap/dist/pwstrength-bootstrap-1.2.7.min.js') }}"></script>
  <script type="text/javascript">
    $(function () {
      $('#password').pwstrength({ui: {
          showVerdictsInsideProgressBar: true
          
        } });
    });
  </script>
@endsection
