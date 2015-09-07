@extends('dashboard.layouts')

@section('title')
  <section class="content-header">
    <h1>
      Business Dashboard
      <small>This is the landing page of the business dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Dashboard</a></li>
      <li class="active">Business</li>
    </ol>
  </section>
@endsection

@section('content')
  <div class="box">
    <div class="box-header with-border">
      Header
    </div><!-- /.box-header -->
    <div class="box-body">
      Body
    </div><!-- /.box-body -->
    <div class="box-footer">
      Footer
    </div><!-- /.box-footer-->
  </div><!-- /.box -->
@endsection