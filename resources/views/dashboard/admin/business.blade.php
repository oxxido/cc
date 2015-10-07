@extends('dashboard.layout')

@section('title')
  <section class="content-header">
    <h1>
      Business Admin Dashboard
      <small>This is the landing page of the business admin dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('dashadmin') }}">Dashboard</a></li>
      <li class="active">Business</li>
    </ol>
  </section>
@endsection

@section('content')
  <div class="box box-primary collapse in" id="businessTable">
    <div class="box-header with-border">
    </div>
    <div class="box-body">
      <table id="businessesTable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Website</th>
          </tr>
        </thead>
        <tbody>
           @foreach ($businesses as $business)
            <tr>
              <td><a href="{{ url('dashbiz/load/'.$business->id )}}">{{ $business->name }}</a></td>
              <td>{{ $business->location }}</td>
              <td><a href="{{ $business->url }}" target="_blank">{{ $business->url }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection