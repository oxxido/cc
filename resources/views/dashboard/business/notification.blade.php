@extends('dashboard.business.layout')

@section('title')
  <section class="content-header">
    <h1>
      Notification Settings
      <small>Change your notification settings from here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Settings</a></li>
      <li class="active">Notification Settings</li>
    </ol>
  </section>
@endsection

@section('form')

    {!! Form::open(array('url'=>url('dashbiz/notification'), 'method'=> 'POST', 'role' => 'form', 'name' => 'notificationForm', 'id' => 'notificationForm')) !!}
      <div>
        <ul class="nav nav-tabs">
          <li class="active">
            <a>Notification Settings Options</a>
          </li>
        </ul>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
        <p>This section allows you to choose which feedback events you want to receive email 
        alerts for and who should receive them.</p>
        <h4>Send to</h4>
          <div class="form-group">
            <input type="checkbox" name="include_social_links" id="include_social_links" value="1"  >
            <label for="include_social_links" >Account Owner</label>
          </div>
          <div class="form-group">
            <input type="checkbox" name="include_social_links" id="include_social_links" value="1" >
            <label for="include_social_links" >Business Manager</label>
          </div>
          <br />
          <h4>Which alerts?</h4>
          <div class="form-group row">
            <div class="col-sm-3"> 
              <select class="form-control " >
               <option>Positive Feedback</option>
               <option>Negative Feedback</option>
               <option>Both Positive and Negative</option>
              </select>
            </div>
          </div>
          <br />
          <h4>What to send?</h4>
          <div class="form-group">
            <div >
            <input type="checkbox" name="include_social_links" id="include_social_links" value="1"  >
            <label for="include_social_links" >Send new online review alerts</label>
          </div>
          <div class="checkbox">
          <label for="performance_report" >
            <input type="checkbox" name="performance_report" id="performance_report" value="1" > <b>Send performance report</b>
          </label>
          </div>
          </div>

        </div>
        <div class="box-footer">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
      </div>
    {!! Form::close() !!}

@endsection

