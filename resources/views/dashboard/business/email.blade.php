@extends('dashboard.business.layout')

@section('title')
  <section class="content-header">
    <h1>
      Email Templates
      <small>Change your email templates settings from here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Settings</a></li>
      <li class="active">Email Templates</li>
    </ol>
  </section>
@endsection

@section('form')

    {!! Form::open(array('url'=>url('dashbiz/email'), 'method'=> 'POST', 'role' => 'form', 'name' => 'emailForm', 'id' => 'emailForm')) !!}
      <div>
        <ul class="nav nav-tabs">
          <li class="active">
            <a>Email Templates</a>
          </li>
        </ul>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <pre>{{ print_r($config,true) }}</pre>
        </div>
        <div class="box-footer">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
      </div>
    {!! Form::close() !!}

@endsection
