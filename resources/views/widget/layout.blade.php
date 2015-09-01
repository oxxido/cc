@extends('layouts.main')

@section('head')
  <link href="{{ asset('vendor/bootstrap-star-rating/css/star-rating.min.css') }}" rel="stylesheet" type="text/css" >
  <style type="text/css">
  .rating-xxs {
    font-size: 1.3em;
  }
  </style>
@endsection

@section('body')
  <section class="top-page">
      <div class="wrapper">

          <div class="logo-cnt"> {{ $product->business->name }}</div>
          <div class="top-image">
              <img src="/images/landscape.jpg" alt="{{ $product->business->name }}">
              <div class="row company-info-cnt">
                  <div class="col-sm-6">{{ $product->business->name }}</div>
                  <div class="col-sm-6 text-right">{{ $product->business->address }} | {{ $product->business->phone }}</div>
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
