@extends('layouts.main')

@section('head')
  <link href="{{ asset('vendor/bootstrap-star-rating/css/star-rating.min.css') }}" rel="stylesheet" type="text/css" >
  <style type="text/css">
  .rating-xxs {
    font-size: 1.3em;
  }
  .top-page .logo-cnt {
    background-image: url('{{ $config->feedback->logoUrl }}');
    background-size: auto 55px;
    background-position: 5px;
  }
  </style>
@endsection

@section('body')
  <section class="top-page">
      <div class="wrapper">
          <div class="logo-cnt"> {{ $config->feedback->pageTitle }}</div>
          <div class="top-image">
              <img src="{{ $config->feedback->bannerUrl }}" alt="{{ $config->feedback->pageTitle }}">
              <div class="row company-info-cnt">
                  <div class="col-sm-6">{{ $business->name }}</div>
                  <div class="col-sm-6 text-right">{{ $business->address }} | {{ $business->phone }}</div>
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
