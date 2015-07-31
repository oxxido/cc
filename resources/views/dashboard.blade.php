@extends('layouts.admin')

@section('body')
	@if (Auth::guest())
		<a href="{{ url('auth/login') }}">Client Login</a>


    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ str_limit(Auth::user()->name,10) }} <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('auth/logout') }}">Logout</a></li>
        </ul>
    </li>
	@else
    

    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="/dashboard" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><i class="fa fa-shield"></i>CC</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><i class="fa fa-shield"></i> Certified Comments</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          
          @include('includes.admin.topmenu')

        </nav>
      </header>

      <!-- =============================================== -->

      @include('includes.admin.menu')
      

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Business Dashboard
            <small>This is the landing page of the business dashboard</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Layout</a></li>
            <li class="active">Fixed</li>
          </ol>
        </section>
        
        
        
        <!-- Main content -->
        <section class="content">
          <!-- TIP -->
          @if(\Session::has('message'))
              <div class="callout callout-info">
                  <p>{{ Session::get('message') }}</p>
              </div>
          @endif
          <div class="alert alert-dismissable collapse" id="errorMessage">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa" id="errorIcon"></i><span id="errorTitle"> Warning!</span></h4>
            <p></p>
          </div>
          <div class="box box-primary collapse" id="userAdd">
                <div class="box-header with-border">
                  <h3 class="box-title">Add business</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(array('url' => 'user', 'method' => 'post', 'role' => 'form', 'name' => 'userAddForm', 'id' => 'userAddForm')) !!}
                {!! Form::token() !!}
                {!! Form::hidden('user_id',$user->id) !!}
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Business Name</label>
                      <input type="text" name="name" placeholder="Enter Business Name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Business Description</label>
                      <textarea name="description" placeholder="Enter Business Description" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="phone">Business Phone</label>
                      <input type="text" name="phone" placeholder="Enter Business Phone" id="phone" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="address">Business Address</label>
                      <input type="text" name="address" placeholder="Enter Business Address" id="address" class="form-control" >
                    </div>
                    <div class="form-group">
                      <label for="url">Business Website</label>
                      <input type="url" name="url" placeholder="Enter Business Website" id="url" class="form-control" required>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button class="btn btn-primary" type="submit" id="userAddSubmit" >Submit</button> 
                    <button data-toggle="collapse" data-target="#userAdd" class="btn btn-primary" type="button">Cancel</button>
                  </div>
                {!! Form::close() !!}
              </div>
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <a data-toggle="collapse" href="#userAdd" aria-expanded="false" aria-controls="userAdd" class="btn btn-app">
                <i class="fa fa-plus"></i> Add Business
              </a>
              <a class="btn btn-app">
                <i class="fa fa-plus"></i> Add Link
              </a>
            </div>
            <div class="box-body">
              <div id="businessesTableDiv">
                
              </div>
            </div><!-- /.box-body -->
           
            <div class="box-footer">
              Footer
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.2.0
        </div>
        
      </footer>

    </div><!-- ./wrapper -->


<!-- Adding templates -->
    @include('handlebars.dashboard-business-table') 

    @endif
@endsection
