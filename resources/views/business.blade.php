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
            <li><a href="#">Dashboard</a></li>
            <li class="active">Business</li>
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
            <button type="button" class="close" data-toggle="collapse" data-target="#errorMessage" aria-hidden="true">&times;</button>
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
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Business Data</h3>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                          <label for="name">Business Name</label>
                          <input type="text" name="name" placeholder="Enter Business Name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea name="description" placeholder="Enter Business Description" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="phone">Phone</label>
                          <input type="text" name="phone" placeholder="Enter Business Phone" id="phone" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="url">Website</label>
                          <input type="url" name="url" placeholder="Enter Business Website" id="url" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="organization_type_id">Organization Type</label>
                          <select class="form-control" name="organization_type_id" placeholder="Enter Organization Type" id="organization_type_id">
                            @foreach ($organization_types as $organization_type)
                              <option value="{{ $organization_type->id }}">{{ $organization_type->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="business_type_id">Business Type</label>
                          <select class="form-control" name="business_type_id" placeholder="Enter Business Type" id="business_type_id">
                            @foreach ($business_types as $business_type)
                              <option value="{{ $business_type->id }}">{{ $business_type->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Business Owner</h3>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                          <label for="bo_first_name">First Name</label>
                          <input type="text" name="bo_first_name" placeholder="Enter Business Owner First Name" id="bo_first_name" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="bo_last_name">Last Name</label>
                          <input type="text" name="bo_last_name" placeholder="Enter Business Owner Last Name" id="bo_last_name" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="bo_email">Email</label>
                          <input type="text" name="bo_email" placeholder="Enter Business Owner Email" id="bo_email" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Business Location</h3>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                          <label for="country_code">Country</label>
                          <select class="form-control" name="country_code" placeholder="Enter Business Type" id="country_code" onchange="cc.location.country()">
                            @foreach ($countries as $country)
                              @if ($country->code == "US")
                                <option value="{{ $country->code }}" selected="selected">{{ $country->name }}</option>
                              @else
                                <option value="{{ $country->code }}">{{ $country->name }}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                        <div id="location_auto">
                          <div class="form-group">
                            <label for="city_zipcode">Zip Code</label>
                            <input type="text" name="city_zipcode" placeholder="Enter Business Zip Code" id="city_zipcode" class="form-control" onchange="cc.location.zipcode()">
                          </div>
                          <div class="form-group">
                            <label>City - State - Zip Code</label>
                            <input type="text" id="city_text" class="form-control" onchange="cc.location.zipcode()" disabled="disabled">
                            <input type="hidden" id="city_id" name="city_id">
                          </div>
                        </div>
                        <div id="location_manual" style="display:none">
                          <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" placeholder="Enter Business City" id="city" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" name="state" placeholder="Enter Business State" id="state" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="zipcode">Zip Code</label>
                            <input type="text" name="zipcode" placeholder="Enter Business Zip Code" id="zipcode" class="form-control">
                          </div>
                        </div>                        
                        <div class="form-group">
                          <label for="address">Street Address</label>
                          <input type="text" name="address" placeholder="Enter Business Street Address" id="address" class="form-control">
                        </div>
                      </div>
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

<div class="modal fade" id="citiesModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select Location</h4>
      </div>
      <div class="modal-body">
        <div class="list-group" id="cities"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Adding templates -->
    @include('handlebars.dashboard-business-table') 

    @endif
@endsection

@section('footer')
<script type="text/javascript">
  $(function () {
    
    cc.business.init();
  });
</script>
@endsection