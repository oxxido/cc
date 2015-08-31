@extends('widget.layout')

@section('content')

  <div class="top-section">
    <p class="title-section">Testimonials</p>
  </div>
  <div class="bottom-section">
    <div id="reviewsTable_HBW"></div>
  </div>

  <div class="top-section">
    <p class="title-section">Your Feedback</p>
  </div>
  <div class="bottom-section">
    @include('widget.feedbackForm')
  </div>

@endsection

@section('footer')

  <script id="reviewsTable_HBT" type="text/x-handlebars-template">
    @include('widget.reviews')
  </script>

  <!-- Paging -->
  <script src="/vendor/paging/jquery.paging.js" type="text/javascript"></script>
  <script src="/js/vendor/jquery.easy-paging.js" type="text/javascript"></script>
  <script type="text/javascript" src="{{ asset('/vendor/handlebars/handlebars.min.js') }}"></script>
  <script type="text/javascript" src="/js/tools.js"></script>
  <script type="text/javascript" src="/js/cc.testimonials.js"></script>
<script type="text/javascript" src="{{ asset('/vendor/bootstrap-star-rating/js/star-rating.min.js') }}"></script>
  <script type="text/javascript">
    $(function () {
      cc.testimonials.init({{ $product->id }});
    });
  </script>

@endsection
