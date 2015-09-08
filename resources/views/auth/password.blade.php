@extends('auth.layout')

@section('content')

<h2>Reset Password</h2>

@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif

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

<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

    <input type="email" class="loginformfield" value="{{ old('email') }}" placeholder="Your Email" id="email"  name="email" required > 
            
    <input type="image" src="/images/btn_send.png" id="imageField" name="submit">
</form>

@endsection
