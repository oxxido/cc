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
    <div>
      <ul class="nav nav-tabs">
        <li class="active">
          <a>Testimonial Widget Options</a>
        </li>
      </ul>
    </div>
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="form-group">
          <input type="checkbox" name="include_feedback" id="include_feedback" @if($config->include_feedback) checked="checked" @endif>
          <label for="include_feedback" >Include feedback form</label>
          <br>
          <input type="checkbox" name="include_likes" id="include_likes" @if($config->include_likes) checked="checked" @endif>
          <label for="include_likes" >Include Facebook Like and Google Plus button</label>
        </div>
      </div>
      <div class="box-footer">
        <button class="btn btn-primary" type="submit">Save</button>
      </div>
    </div>
  {!! Form::close() !!}

  <div>
    <ul class="nav nav-tabs">
      <li class="active">
        <a>Integration Site</a>
      </li>
    </ul>
  </div>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="form-group">
        <label for="codeForSite">Widget Code <small>Use this code to add the testimonial widget on your site</small></label>
        <textarea id="codeForSite"  rows="3" class="form-control noresize" readonly="readonly"><iframe src="{{ url("widget/testimonial/$product->hash") }}"></iframe></textarea>
        
      </div>
      <div class="row">
        <div class="col-sm-12">
        <a class="btn btn-primary" target="_blank" href="{{ url("widget/testimonial/$product->hash") }}">Test Link</a>
        </div>
      </div>
    </div>
  </div>
@endsection
