@extends('widget.layout')

@section('content')
  @if($config->testimonial->include_likes)
    <article class="social">
      <div class="top-section">
        <div id="fb-root"></div>
        <div class="g-plusone" data-size="tall"></div>
        <div class="fb-like" data-width="350" data-layout="box_count" data-action="recommend"></div>
      </div>
    </article> 
  @endif
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

  <script type="text/javascript">
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.4";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <script type="text/javascript">
    (function() {
      var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
      po.src = 'https://apis.google.com/js/platform.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
  </script>
@endsection
