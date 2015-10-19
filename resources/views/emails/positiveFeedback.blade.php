@extends('emails.layout')

@section('body')
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td>

              <?=$header?>

              <ul>
                @foreach($links as $link)
                  <li><a href="{{ $link['profile'] }}" target="_blank">{{ $link['social_network']['name'] }}</a></li>
                @endforeach
              </ul>

              <?=$footer?>

            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
@endsection
@section('foot')
  @if(isset($suscription))
    <p>If you don't want to receive more mails from this business click <a href="{{ url($suscription) }}" target="_blank">here</a> to unsuscribe</p>
  @endif
@endsection