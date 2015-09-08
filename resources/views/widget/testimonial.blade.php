@extends('widget.layout')

@section('content')

  <div class="top-section">
    <p class="title-section">Testimonials</p>
  </div>
  <div class="bottom-section">
    <div id="reviewsTable_HBW"></div>
  </div>

  @if($config->testimonial->include_feedback)
    <div class="top-section">
      <p class="title-section">Your Feedback</p>
    </div>
    <div class="bottom-section">
      @include('widget.feedbackForm')
    </div>
  @endif

@endsection

@section('foot')

  <script id="reviewsTable_HBT" type="text/x-handlebars-template">
    @include('widget.reviews')
  </script>

  <script type="text/javascript" src="{{ asset('/vendor/handlebars/handlebars.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/vendor/paging/jquery.paging.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/vendor/jquery.easy-paging.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/cc.testimonials.js') }}"></script>
  <script type="text/javascript">
    $(function () {
      cc.testimonials.init({{ $product->id }});
    });
  </script>

@endsection
