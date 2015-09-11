@extends('emails.layout')

@section('body')
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td>
              <h1>{{ $name }} wrote a negative feedback</h1>
              <p class="lead">Lorem ipsum...</p>
              <p>
                Loremp ipsum
              </p>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
@endsection
