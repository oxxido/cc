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
