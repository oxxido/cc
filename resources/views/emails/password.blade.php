@extends('emails.layout')

@section('body')
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td>
              <h1>Hi, {{ $user['name'] }}</h1>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>


  <table class="row callout">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td class="panel">
              <p><a href="{{ url('password/reset/'.$token) }}">Click here</a> to reset your password</p>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

@endsection

