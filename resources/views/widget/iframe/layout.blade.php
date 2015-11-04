<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" lang="en" content="CertifiedComments.com" />
    <meta name="description" content="CertifiedComments.com is today's leading trust seal. Available by invite only, our website trust seal certifies all testimonials and customer comments." />
    <meta name="keyword" content="Trust Seal, Website Trust Seal, Certified Comments, Customer Testimonials, authenticated testimonials" />
    <meta name="robots" content="Index,Follow" />
    <title>Trust Seal | Website Trust Seal | CertifiedComments.com</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/bootstrap/dist/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="{{ asset('vendor/bootstrap-star-rating/css/star-rating.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/widget.css') }}" rel="stylesheet" type="text/css" >

  </head>
  <body>
    <?php /*
    <header>
      <div class="row">
        <div class="col-xs-4">
          <img src="{{ $config->feedback->logo_url }}" class="img-responsive">
        </div>
        <div class="col-xs-8">
          {{ $config->feedback->page_title }}
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">{{ $business->name }}</div>
        <div class="col-xs-6 text-right">{{ $business->address }} | {{ $business->phone }}</div>
      </div>
    </header>
    */ ?>
    <section class="wrapper">
      @yield('content')
    </section>

    <footer>
      <p class="text-center"><small>&copy; 2014 CertifiedComments.com</small></p>
    </footer>

    <script type="text/javascript" src="{{ asset('/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/bootstrap-star-rating/js/star-rating.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/jquery.scrollTo/jquery.scrollTo.min.js') }}"></script>

    <script type="text/javascript">
      if (!cc) var cc = {};
      cc.ver = "0.0.1";
      cc.baseUrl = "{{url()}}/";
    </script>
    <script type="text/javascript" src="{{ asset('/js/tools.js') }}"></script>

    @yield('foot')

  </body>
</html>
