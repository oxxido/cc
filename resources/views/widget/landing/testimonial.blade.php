@extends('widget.landing.layout')

@section('content')

  <article class="social">
    <div class="top-section">
      <div id="fb-root"></div>
      <div class="g-plusone" data-size="tall"></div>
      <div class="fb-like" data-width="350" data-layout="box_count" data-action="recommend"></div>
    </div>
  </article>

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
      @include('widget.landing.feedbackForm')
    </div>
  @endif

@endsection

@section('foot')

  <script id="reviewsTable_HBT" type="text/x-handlebars-template">
    @include('widget.landing.reviews')
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

  @include('widget.likes')

@endsection
