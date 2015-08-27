@extends('dashboard.crud.layout')

@section('title')
  <section class="content-header">
    <h1>
      Testimonial Settings
      <small>Change your testimonial widget from here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Settings</a></li>
      <li class="active">Testimonial</li>
    </ol>
  </section>
@endsection

@section('content')

  <div class="box box-primary collapse in" id="businessAdd">
    <div class="box-header with-border">
      <h3 class="box-title">Add Business</h3>
    </div>
    <div id="businessAddForm_HBW"> <div class="box-body">
  <div>
    <ul class="nav nav-tabs">
      <li class="active">
        <a>Business Data</a>
      </li>
    </ul>
  </div>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="form-group">
        <label for="name">Business Name</label>
        <input type="text" name="name" placeholder="Enter Business Name" id="name" class="form-control" value="@{{name}}" required>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" placeholder="Enter Business Description" id="description" rows="3" class="form-control">@{{description}}</textarea>
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" placeholder="Enter Business Phone" id="phone" class="form-control" value="@{{phone}}">
      </div>
      <div class="form-group">
        <label for="url">Website Url (http://)</label>
        <input type="url" name="url" placeholder="Enter Business Website" id="url" class="form-control" required value="@{{url}}">
      </div>
      <div class="form-group">
        <label for="organization_type_id">Organization Type</label>

      </div>
      <div class="form-group">
        <label for="business_type_id">Business Type</label>

      </div>
    </div>
  </div>
  <div class="admin-nav-tabs">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation">
        <a href="#admin_tab_new" aria-controls="admin_tab_new" role="tab" data-toggle="tab" isnew="1">New Business Admin</a>
      </li>
      <li role="presentation" class="active">
        <a href="#admin_tab_search" aria-controls="admin_tab_search" role="tab" data-toggle="tab" isnew="0">Search Business Admin</a>
      </li>
    </ul>
    <input type="hidden" name="new_admin" id="new_admin" value="0">
    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane" id="admin_tab_new">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="form-group">
              <label for="admin_first_name">First Name</label>
              <input type="text" name="admin_first_name" placeholder="Enter Business Admin First Name" id="admin_first_name" class="form-control">
            </div>
            <div class="form-group">
              <label for="admin_last_name">Last Name</label>
              <input type="text" name="admin_last_name" placeholder="Enter Business Admin Last Name" id="admin_last_name" class="form-control">
            </div>
            <div class="form-group">
              <label for="admin_email">Email</label>
              <input type="text" name="admin_email" placeholder="Enter Business Admin Email" id="admin_email" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane active" id="admin_tab_search">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="form-group">
              <label for="admin_first_name">Business Admin Name or Email</label>
              <div class="input-group">
                <input type="text" class="form-control" name="admin_search" id="admin_search" placeholder="Enter Business Admin Name or Email">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button" onclick="cc.crud.business.admin.search()">Search</button>
                </span>
              </div>
              <input type="hidden" id="admin_id" name="admin_id" value="@{{admin.id}}">
            </div>
            <div class="alert alert-warning" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              Business Admin not matching or not found
            </div>
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="admin_search_name" placeholder="Business Admin Name" id="admin_search_name" value="@{{admin.name}}" class="form-control" disabled="disabled">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="admin_search_email" placeholder="Business Admin Email" id="admin_search_email" value="@{{admin.email}}" class="form-control"  disabled="disabled">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div>
    <ul class="nav nav-tabs">
      <li class="active">
        <a>Business Location</a>
      </li>
    </ul>
  </div>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="form-group">
        <label for="country_code">Country</label>

        <input type="hidden" name="new_city" id="new_city" value="0">
        <input type="hidden" id="city_id" name="city_id" value="@{{city_id}}">
      </div>
      <div id="location_auto">
        <div class="form-group">
          <label for="city_zip_code">Zip Code</label>
          <div class="input-group">
            <input type="text" class="form-control" name="city_zip_code" id="city_zip_code" placeholder="Enter Business Zip Code" value="@{{city.zip_code}}">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button" onclick="cc.location.zip_code()">Search</button>
            </span>
          </div>
        </div>
        <div class="alert alert-warning" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          Locations not matching or not found
        </div>
        <div class="form-group">
          <label>City - State - Zip Code</label>
          <input type="text" id="city_location" class="form-control" onchange="cc.location.zip_code()" disabled="disabled" value="@{{city.location}}">
        </div>
      </div>

      <div id="location_manual" style="display:none">
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" name="city_name" placeholder="Enter Business City" id="city_name" class="form-control" value="@{{city.name}}">
        </div>
        <div class="form-group">
          <label for="state_name">State</label>
          <input type="text" name="state_name" placeholder="Enter Business State" id="state_name" class="form-control" value="@{{city.state.name}}">
        </div>
        <div class="form-group">
          <label for="zip_code">Zip Code</label>
          <input type="text" name="zip_code" placeholder="Enter Business Zip Code" id="zip_code" class="form-control" value="@{{city.zip_code}}">
        </div>
      </div>                        
      <div class="form-group">
        <label for="address">Street Address</label>
        <input type="text" name="address" placeholder="Enter Business Street Address" id="address" class="form-control" value="@{{address}}">
      </div>
    </div>
  </div>
</div><!-- /.box-body --></div>
    
  </div>


@endsection

