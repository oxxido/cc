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
  <img width="256" vspace="20" height="256" src="/images/inviteicon.png">
<h2>Thanks for your interest!</h2>
Leave us your information and we'll send you an invite as soon as we're ready.
@if($errors->any())
              
              @foreach ($errors->all() as $error)
                <div class="alert alert-warning" role="alert">
                <p> {{ $error }}</p>
                </div>
              @endforeach
              
          @endif
  <div style="height:20px;"></div>
    
    <form action="/request" method="post" name="contactform">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="text"  class="loginformfield" value="{{ old('name') }}" placeholder="Your Name" id="name"  name="name" required>
      <input type="text"  class="loginformfield" value="{{ old('company') }}" placeholder="Your Company" id="company"  name="company" required > 
      <input type="email" class="loginformfield" value="{{ old('email') }}" placeholder="Your Email" id="email"  name="email" required>
      <input type="url"   class="loginformfield" value="{{ old('website') }}" placeholder="Your Website URL" id="website"  name="website" required>
      
      <input type="image" src="/images/btn_invite.png" id="imageField" name="submit">
    </form>
  </div>
</div>


@endsection
