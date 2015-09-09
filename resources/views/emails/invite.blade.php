@extends('emails.layout')

@section('body')
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td>
              <h1>Requested Invite</h1>
              <p class="lead">Following user requested an invite:</p>
              <p>
                {{ $name }} <br>
                {{ $company }} <br>
                {{ $email }} <br>
                {{ $website }} <br>
              </p>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
@endsection
