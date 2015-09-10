@extends('emails.layout')

@section('body')
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td>
              <h1>Hi, admin</h1>
              <p class="lead">New contact message</p>
               <p>Name: {{ $name }}</p>
               <p>Company: {{ $company }}</p>
               <p>Email: {{ $email }}</p>
               <p>Website: {{ $website }}</p>
               <p>Message:</p>
               <p>{{ $msg }}</p>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
@endsection
