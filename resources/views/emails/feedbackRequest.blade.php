@extends('emails.layout')

@section('body')
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td>
              {!! $body !!}
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
@endsection
@section('foot')
  <p>If you don't want to receive more mails from this business click <a href="{{ url($suscription) }}" target="_blank">here</a> to unsuscribe</p>
@endsection