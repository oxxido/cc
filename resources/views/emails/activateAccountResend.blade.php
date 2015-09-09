@extends('emails.layout')

@section('body')
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td>
              <h1>Hi, {{ $name }}</h1>
              <p class="lead">Thank you for signing up</p>
              <p>To get started, please verify your email address here:</p>
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
              <p>Click to verify your account <a href="{{ url('auth/activate/'.$code) }}">Verify it »</a></p>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  <table class="row footer">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td class="expander"></td>
            <td align="center">
              <p>To keep our systems healthy and your accounts safe, we limited the amount of mail one user can send</p>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  <table class="row footer">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td class="expander"></td>
            <td align="center">
              <p>If you did not sign up for certifiedcomments, or if you have
              any questions, just email us at info@certifiedcomments.com and we'll be happy to help.</p>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
@endsection
