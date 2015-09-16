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
      <ul class="nav nav-tabs" role="tablist">
        <li class="active">
          <a href="#tab_request" aria-controls="tab_request" role="tab" data-toggle="tab">Feedback Request Email</a>
        </li>
        <li>
          <a href="#tab_positive" aria-controls="tab_positive" role="tab" data-toggle="tab">Positive Feedback Email</a>
        </li>
        <li>
          <a href="#tab_negative" aria-controls="tab_negative" role="tab" data-toggle="tab">Negative Feedback Email</a>
        </li>
      </ul>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab_request">
              <div class="form-group">
                <label for="feedback_request_from">Feedback Request Sender Email (From: )</label>
                <input type="text" name="feedback_request_from" id="feedback_request_from" class="form-control" value="{{ $config->feedback_request_from }}">
              </div>
              <div class="form-group">
                <label for="feedback_request_subject">Subject</label>
                <input type="text" name="feedback_request_subject" id="feedback_request_subject" class="form-control" value="{{ $config->feedback_request_subject }}">
              </div>
              <div class="form-group">
                <label for="feedback_request_body">Email Body</label>
                <textarea class="form-control" rows="12" name="feedback_request_body" id="feedback_request_body">{{ $config->feedback_request_body }}</textarea>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_positive">
              <div class="form-group">
                <label for="positive_feedback_subject">Subject</label>
                <input type="text" name="positive_feedback_subject" id="positive_feedback_subject" class="form-control" value="{{ $config->positive_feedback_subject }}">
              </div>
              <div class="form-group">
                <label for="positive_feedback_body">Email Body</label>
                <textarea class="form-control" rows="15" name="positive_feedback_body" id="positive_feedback_body">{{ $config->positive_feedback_body }}</textarea>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_negative">
              <div class="form-group">
                <label for="negative_feedback_subject">Subject</label>
                <input type="text" name="negative_feedback_subject" id="negative_feedback_subject" class="form-control" value="{{ $config->negative_feedback_subject }}">
              </div>
              <div class="form-group">
                <label for="negative_feedback_body">Email Body</label>
                <textarea class="form-control" rows="15" name="negative_feedback_body" id="negative_feedback_body">{{ $config->negative_feedback_body }}</textarea>
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

@section('footer')
  <script type="text/javascript" src="{{ asset('/vendor/tinymce/tinymce.min.js') }}"></script>
  <script type="text/javascript">
    tinymce.init({
      selector: "textarea",
      height: 300,
      statusbar: false,
      toolbar: "undo redo taging",
      menubar: false,
      object_resizing: false,
      external_plugins: {
        "taging": "{{ asset('/js/vendor/taging/plugin.min.js') }}"
      }
    });

    $("#emailForm").bind('submit', function(){
      $("textarea").each(function(i, textarea){
        var body = $(textarea).val();
        tinymce.editors[0].destroy();
        $(textarea).val(body);
      });
      return true;
    });
  </script>
@endsection
