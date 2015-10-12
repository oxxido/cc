@extends('dashboard.business.layout')

@section('form')

  <h3>Notification Settings</h3>
  <p>This section allows you to choose which feedback events you want to receive email alerts for and who should receive them</p>
  <br>

  {!! Form::open(['url'=>route('business.dashboard.notification', $business), 'method'=> 'POST', 'role' => 'form', 'name' => 'notificationForm', 'id' => 'notificationForm']) !!}
    <div class="panel panel-success">
      <div class="panel-heading"></div>
      <div class="panel-body">
        <h4>Send to</h4>
        <div class="form-group">
          {!! Form::checkbox('send_to_owner', 1, $config->send_to_owner, ['id' => 'send_to_owner']) !!}
          {!! Form::label('send_to_owner', trans('business.fields.notifications.send_to_owner')) !!}
        </div>
        <div class="form-group">
          {!! Form::checkbox('send_to_admin', 1, $config->send_to_admin, ['id' => 'send_to_admin']) !!}
          {!! Form::label('send_to_admin', trans('business.fields.notifications.send_to_admin')) !!}
        </div>
        <br />
        <h4>Which alerts?</h4>
          <div class="form-group">
              {!! Form::checkbox('alert_positive', 1, $config->alert_positive, ['id' => 'alert_positive']) !!}
              {!! Form::label('alert_positive', trans('business.fields.notifications.alert_positive')) !!}
          </div>
          <div class="form-group">
              {!! Form::checkbox('alert_negative', 1, $config->alert_negative, ['id' => 'alert_negative']) !!}
              {!! Form::label('alert_negative', trans('business.fields.notifications.alert_negative')) !!}
          </div>
        <br />
        <h4>What to send?</h4>
        {{--
        <div class="form-group">
            {!! Form::checkbox('send_alerts', 1, $config->send_alerts, ['id' => 'send_alerts']) !!}
            {!! Form::label('send_alerts', trans('business.fields.notifications.send_alerts')) !!}
        </div>
        --}}
        <div class="form-group">
            {!! Form::checkbox('send_reports', 1, $config->send_reports, ['id' => 'send_reports']) !!}
            {!! Form::label('send_reports', trans('business.fields.notifications.send_reports')) !!} &nbsp;
            {!! Form::select('frequency', \App\Models\Business::configNotificationsFrequencies(), $config->frequency, ['class' => '']) !!}
        </div>
      </div>
      <div class="panel-footer">
        <button class="btn btn-success" type="submit">Save</button>
      </div>
    </div>
  {!! Form::close() !!}

@endsection
