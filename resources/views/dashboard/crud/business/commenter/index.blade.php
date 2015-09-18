@extends('dashboard.crud.layout')

@section('title')
  <section class="content-header">
    <h1>
      Business <i>{{ $business->name }}</i>: Customers list
      <small>This is the list of available customers for this business</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Business</a></li>
      <li class="active">Customers</li>
    </ol>
  </section>
@endsection

@section('content')
  <!-- Default box -->
  <div class="box collapse in" id="commenters_table">
    <div class="box-header with-border">
      <a href="{{ URL::route('business.commenter.create', $business) }}" class="btn btn-app">
        <i class="fa fa-plus"></i> Add Customer
      </a>
        @include('dashboard.crud.business.commenter.table', [$business, 'commenters_page' => $business->commenters()->paginate()])
    </div>
  </div><!-- /.box -->
@endsection

@section('footer')
@endsection

