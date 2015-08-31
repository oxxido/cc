@extends('widget.layout')

@section('content')
  <div class="top-section">
      <p class="title-section">Your Feedback</p>
  </div>
  <div class="bottom-section">

    @include('widget.feedbackForm')

  </div>
@endsection

@section('footer')
<script type="text/javascript" src="{{ asset('/vendor/bootstrap-star-rating/js/star-rating.min.js') }}"></script>
@endsection