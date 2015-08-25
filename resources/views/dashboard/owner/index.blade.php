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
  <div class="box box-primary collapse" id="adminAdd">
    <div class="box-header with-border">
      <h3 class="box-title">Add User</h3>
    </div>
    <div id="adminAddForm_HBW"></div>
    <div class="overlay" id="adminAddLoading">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
  </div>
@endsection

@section('foot')
@endsection