@extends('commenter.layout')

@section('content')
  <div class="top-section">
      <p class="title-section">{{ $commenter->phone }}</p>
  </div>
  <div class="bottom-section">

    @include('commenter.suscriptionForm2')

  </div>
@endsection
