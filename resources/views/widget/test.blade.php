@extends('layouts.main')

@section('header')
  @include('includes.headerpages')
@endsection

@section('body')

  <div class="wrapper">
    <h2>Widget Test</h2>
    <div class="row">
      <div class="col-xs-5">
        <h3>Testimonial Widget</h3>
        <script type="text/javascript" id="cc-widget-testimonial-{{ $product_uuid }}" src="{{ url("widget/script.js?type=testimonial&uuid={$product_uuid}") }}"></script>
      </div>
      <div class="col-xs-2"></div>
      <div class="col-xs-5">
        <h3>Feedback Widget</h3>
        <script type="text/javascript" id="cc-widget-feedback-{{ $product_uuid }}" src="{{ url("widget/script.js?type=feedback&uuid={$product_uuid}") }}"></script>
      </div>
    </div>
  </div>

@endsection