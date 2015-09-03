@extends('widget.layout')

@section('content')
    @section('content')
  <div class="top-section">
      <p class="title-section">Positive Feedback</p>
  </div>
  <div class="bottom-section">
    <div>
      <?=$config->feedback->positiveFeedbackPage?>
    </div>

    @if($config->feedback->includeSocialLinks)
      <div class="links-list">
        <ul class="list-group">
          @foreach($links as $link)
            <li class="list-group-item links">
              <div class="row">
                <div class="col-xs-6 link-logo">
                  <a href="{{ $link->profile }}" target="_blank"><img src="{{ asset($link->socialNetwork->logo) }}"></a>
                </div>
                <div class="col-xs-6 link-btn">
                  <a href="{{ $link->profile }}" target="_blank" class="btn btn-warning"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Write a Review</a>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    @endif

  </div>
@endsection
