@extends('widget.iframe.layout')

@section('content')

  <section>
    <h3>Positive Feedback</h3>

    <?=$config->feedback->positive_text_header?>

    @if($config->feedback->include_social_links)
      <div>
        <ul class="list-group">
          @foreach($links as $link)
            <li class="list-group-item">
              <div class="row">
                <div class="col-xs-6">
                  <a href="{{ $link->profile }}" target="_blank"><img src="{{ asset($link->socialNetwork->logo) }}"></a>
                </div>
                <div class="col-xs-6">
                  <a href="{{ $link->profile }}" target="_blank" class="btn btn-warning"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Write a Review</a>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    @endif

    <?=$config->feedback->positive_text_footer?>

  </div>
@endsection
