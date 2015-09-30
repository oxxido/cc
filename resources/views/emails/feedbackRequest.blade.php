@extends('emails.layout')

@section('body')
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td>
              <h1>{{ $name }}, we required your feedback</h1>
              <p>These business require a few minutes from you, please help them giving one.</p>
              <p>Just click on each link and submit a review. Thanks.</p>
              @foreach($businesses as $business)
                  <a href="{{ URL::to("widget/feedback/{$business['hash']}") }}">{{ $business['name'] }}</a>:
                  <a href="{{ URL::to("widget/feedback/{$business['hash']}") }}">{{ URL::to("widget/feedback/{$business['hash']}") }}</a>
              @endforeach
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
@endsection
