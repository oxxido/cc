@extends('widget.iframe.layout')

@section('content')

  <section>
    <h3>Thank You</h3>

    <?=$config->feedback->negative_text?>

    @if(!isset($noform))
      <br>
      <div class="panel panel-default">
        <div class="panel-heading">Your experience</div>
        <div class="panel-body">
          @include('widget.iframe.negativeFeedbackForm')
        </div>
      </div>
    @endif

  </section>

@endsection
