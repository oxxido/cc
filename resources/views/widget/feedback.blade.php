@extends('widget.layout')

@section('content')
  <div class="top-section">
      <p class="title-section">Your Feedback</p>
  </div>
  <div class="bottom-section">

    @include('widget.feedbackForm')

  </div>
@endsection
