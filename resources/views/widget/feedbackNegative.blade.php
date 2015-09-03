@extends('widget.layout')

@section('content')

  <div class="top-section">
      <p class="title-section">Thank You</p>
  </div>
  <div class="bottom-section">
    <div>
      <?=$config->feedback->negativeFeedbackPage?>
    </div>

    @include('widget.negativeFeedbackForm')

  </div>

@endsection
