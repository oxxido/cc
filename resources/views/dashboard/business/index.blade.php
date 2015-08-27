@extends('dashboard.layout')

@section('title')
  <section class="content-header">
    <h1>
      Business Dashboard
      <small>This is the landing page to business dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Dashboard</a></li>
      <li class="active">Business Dashboard</li>
    </ol>
  </section>
@endsection

@section('content')
  <pre>{{ print_r($business) }}</pre>
@endsection

@section('foot')
@endsection