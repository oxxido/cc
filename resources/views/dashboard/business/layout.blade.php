@extends('dashboard.layout')

@section('content')

  @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  @if (isset($saved))
      <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <p>Successfully saved!</p>
      </div>
  @endif

  <div class="box box-primary collapse in" id="config-form">
    @yield('form')
  </div>

@endsection
