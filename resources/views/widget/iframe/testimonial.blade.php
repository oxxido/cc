@extends('widget.iframe.layout')

@section('content')

  <section>
    <div class="g-plusone" data-size="tall"></div>
    <div class="fb-like" data-width="350" data-layout="box_count" data-action="recommend" style="top: -4px;"></div>
  </section>

  <section>
    <h3>Testimonials</h3>
    <div id="reviewsTable_HBW"></div>
  </section>

  @if($config->testimonial->include_feedback)
    <section>
      @include('widget.iframe.feedbackForm')
    </section>
  @endif

@endsection

@section('foot')

  <script id="reviewsTable_HBT" type="text/x-handlebars-template">
    @include('widget.iframe.reviews')
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
