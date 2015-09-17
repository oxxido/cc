@extends('dashboard.business.layout')

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

@section('form')

  {!! Form::open(array('url'=>url('dashbiz/testimonial'), 'method'=> 'POST', 'role' => 'form', 'name' => 'testimonialForm', 'id' => 'testimonialForm')) !!}
    <ul class="nav nav-tabs" role="tablist">
      <li class="active">
        <a href="#tab_config" aria-controls="tab_config" role="tab" data-toggle="tab">Testimonial Widget Options</a>
      </li>
      <li>
        <a href="#tab_code" aria-controls="tab_code" role="tab" data-toggle="tab">Integration</a>
      </li>
    </ul>
    <div class="panel panel-default">
      <div class="panel-body">

        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="tab_config">
            <div class="form-group">
              <input type="checkbox" name="include_feedback" id="include_feedback" @if($config->include_feedback) checked="checked" @endif>
              <label for="include_feedback" >Include feedback form</label>
            </div>
            <div>
              <input type="checkbox" name="include_likes" id="include_likes" @if($config->include_likes) checked="checked" @endif>
              <label for="include_likes" >Include Facebook Like and Google Plus button</label>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="tab_code">
            <div class="form-group">
              <label for="codeForSite">Widget Code <small>Use this code to add the testimonial widget on your site</small></label>
              <pre>{{ htmlentities('<iframe src="' . url("widget/testimonial/$product->hash") . '"></iframe>') }}</pre>
            </div>
            <div class="row">
              <div class="col-sm-12 text-right">
                <a class="btn btn-default btn-sm" target="_blank" href="{{ url("widget/testimonial/$product->hash") }}">Test Link</a>
              </div>
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
