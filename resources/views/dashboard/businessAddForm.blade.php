<div class="box box-primary collapse" id="businessAdd">
  <div class="box-header with-border">
    <h3 class="box-title">Add business</h3>
  </div><!-- /.box-header -->
  <!-- form start -->
  {!! Form::open(array('url' => 'business', 'method' => 'post', 'role' => 'form', 'name' => 'businessAddForm', 'id' => 'businessAddForm')) !!}
    <div class="box-body">
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
            <input type="text" name="name" placeholder="Enter Business Name" id="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" placeholder="Enter Business Description" id="description" rows="3" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" placeholder="Enter Business Phone" id="phone" class="form-control">
          </div>
          <div class="form-group">
            <label for="url">Website Url (http://)</label>
            <input type="url" name="url" placeholder="Enter Business Website" id="url" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="organization_type_id">Organization Type</label>
            <select class="form-control" name="organization_type_id" placeholder="Enter Organization Type" id="organization_type_id">
              <option></option>
              @foreach ($organization_types as $organization_type)
                <option value="{{ $organization_type->id }}">{{ $organization_type->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="business_type_id">Business Type</label>
            <select class="form-control" name="business_type_id" placeholder="Enter Business Type" id="business_type_id">
              <option></option>
              @foreach ($business_types as $business_type)
                <option value="{{ $business_type->id }}">{{ $business_type->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="admin-nav-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active">
            <a href="#admin_tab_new" aria-controls="admin_tab_new" role="tab" data-toggle="tab" isnew="1">New Business Admin</a>
          </li>
          <li role="presentation">
            <a href="#admin_tab_search" aria-controls="admin_tab_search" role="tab" data-toggle="tab" isnew="0">Search Business Admin</a>
          </li>
        </ul>
        <input type="hidden" name="new_admin" id="new_admin" value="1">
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="admin_tab_new">
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
          <div role="tabpanel" class="tab-pane" id="admin_tab_search">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label for="admin_first_name">Business Admin Name or Email</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="admin_search" id="admin_search" placeholder="Enter Business Admin Name or Email">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button" onclick="cc.business.admin.search()">Search</button>
                    </span>
                  </div>
                  <input type="hidden" id="admin_id" name="admin_id">
                </div>
                <div class="alert alert-warning" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  Business Admin not matching or not found
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="admin_search_name" placeholder="Business Admin Name" id="admin_search_name" class="form-control" disabled="disabled">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="admin_search_email" placeholder="Business Admin Email" id="admin_search_email" class="form-control"  disabled="disabled">
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
            <select class="form-control" name="country_code" placeholder="Enter Business Type" id="country_code" onchange="cc.location.country()">
              @foreach ($countries as $country)
                @if ($country->code == "US")
                  <option value="{{ $country->code }}" selected="selected">{{ $country->name }}</option>
                @else
                  <option value="{{ $country->code }}">{{ $country->name }}</option>
                @endif
              @endforeach
            </select>
            <input type="hidden" name="new_city" id="new_city" value="0">
          </div>
          <div id="location_auto">
            <div class="form-group">
              <label for="city_zipcode">Zip Code</label>
              <div class="input-group">
                <input type="text" class="form-control" name="city_zipcode" id="city_zipcode" placeholder="Enter Business Zip Code">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button" onclick="cc.location.zipcode()">Search</button>
                </span>
              </div>
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
              <input type="text" name="cityname" placeholder="Enter Business City" id="city" class="form-control">
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
      <button class="btn btn-primary" type="submit" id="businessAddSubmit">Submit</button> 
      <button data-toggle="collapse" data-target="#businessAdd" class="btn btn-default" type="button">Cancel</button>
    </div>
  {!! Form::close() !!}
</div>


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

<div class="modal fade" id="boSearchModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select Location</h4>
      </div>
      <div class="modal-body">
        <div class="list-group result"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

