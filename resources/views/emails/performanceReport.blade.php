@extends('emails.layout')

@section('body')
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td>
              <h1>{{ $name }}, this is the performance report for {{ $business['name'] }}</h1>
              <p class="lead">Lorem ipsum...</p>
              <p>
                Comments: {{ $business['comments'] }}
              </p>
              <p>
                Ratings total: {{ $business['sum_ratings'] }}
              </p>
              <p>
                Ratings avg: {{ $business['avg_ratings'] }}
              </p>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
@endsection
