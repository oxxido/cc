@extends('layouts.main')

@section('head')
  <link href="{{ asset('vendor/bootstrap-star-rating/css/star-rating.min.css') }}" rel="stylesheet" type="text/css" >
  <style type="text/css">
  .rating-xxs {
    font-size: 1.3em;
  }
  body {
    background: #EEE;
  }
  section.feedback {
    padding: 5px;
  }
  .logo-title-cnt {
    background-color: #FFF;
  }
  </style>
@endsection

@section('body')
  <section class="top-page">
    <div class="wrapper">
      <div class="row logo-title-cnt">
        <div class="col-xs-6">
          <div class="logo-cnt">
            <img src="{{ $config->feedback->logoUrl }}">
          </div>
        </div>
        <div class="col-xs-6">
          <div class="title-cnt">
            {{ $config->feedback->pageTitle }}
          </div>
        </div>
      </div>
      <div class="top-image">
        <img src="{{ $config->feedback->bannerUrl }}" alt="{{ $config->feedback->pageTitle }}">
        <div class="row company-info-cnt">
          <div class="col-xs-6">{{ $business->name }}</div>
          <div class="col-xs-6 text-right">{{ $business->address }} | {{ $business->phone }}</div>
        </div>
      </div>
    </div>
  </section>
  <section class="feedback">
    <div class="wrapper">
      <div class="bg-panel">
        @yield('content')
      </div>
    </div>
  </section>
@endsection

@section('footer')
  <script type="text/javascript" src="{{ asset('/vendor/bootstrap-star-rating/js/star-rating.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/tools.js') }}"></script>
  @yield('foot')
@endsection
