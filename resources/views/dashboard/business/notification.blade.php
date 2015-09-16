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
    {!! Form::open(['url'=>url('dashbiz/notification'), 'method'=> 'POST', 'role' => 'form', 'name' => 'notificationForm', 'id' => 'notificationForm']) !!}
      <ul class="nav nav-tabs" role="tablist">
        <li class="active">
          <a href="#tab_config" aria-controls="tab_config" role="tab" data-toggle="tab">Notification Settings Options</a>
        </li>
      </ul>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab_config">
              <p>This section allows you to choose which feedback events you want to receive email
              alerts for and who should receive them.</p>
              <h5>Send to</h5>
              <div class="form-group">
                {!! Form::checkbox('send_to_owner', 1, $config->send_to_owner) !!}
                {!! Form::label('send_to_owner', trans('business.fields.notifications.send_to_owner')) !!}
              </div>
              <div class="form-group">
                {!! Form::checkbox('send_to_admin', 1, $config->send_to_admin) !!}
                {!! Form::label('send_to_admin', trans('business.fields.notifications.send_to_admin')) !!}
              </div>
              <br />
              <h5>Which alerts?</h5>
                <div class="form-group">
                    {!! Form::checkbox('alert_positive', 1, $config->alert_positive) !!}
                    {!! Form::label('alert_positive', trans('business.fields.notifications.alert_positive')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('alert_negative', 1, $config->alert_negative) !!}
                    {!! Form::label('alert_negative', trans('business.fields.notifications.alert_negative')) !!}
                </div>
              <br />
              <h5>What to send?</h5>
              {{--
              <div class="form-group">
                  {!! Form::checkbox('send_alerts', 1, $config->send_alerts) !!}
                  {!! Form::label('send_alerts', trans('business.fields.notifications.send_alerts')) !!}
              </div>
              --}}
              <div class="form-group">
                  {!! Form::checkbox('send_reports', 1, $config->send_reports) !!}
                  {!! Form::label('send_reports', trans('business.fields.notifications.send_reports')) !!}
                  {!! Form::select('frequency', \App\Models\Business::configNotificationsFrequencies(), $config->frequency, ['class' => 'form-control']) !!}
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
      </div>
    {!! Form::close() !!}

@endsection
