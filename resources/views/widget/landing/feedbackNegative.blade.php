@extends('widget.landing.layout')

@section('content')

  <div class="top-section">
      <p class="title-section">Thank You</p>
  </div>
  <div class="bottom-section">
    <p>
      <?=$config->feedback->negative_text?>
    </p>

    @if(!isset($noform))
      <br>
      <div class="panel panel-default">
        <div class="panel-heading">Your experience</div>
        <div class="panel-body">
          @include('widget.landing.negativeFeedbackForm')
        </div>
      </div>
    @endif

  </div>

@endsection
