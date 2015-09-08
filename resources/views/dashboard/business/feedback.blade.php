@extends('dashboard.business.layout')

@section('title')
  <section class="content-header">
    <h1>
      Feedback Widget
      <small>Change your feedback widget from here</small>
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

    {!! Form::open(array('url'=>url('dashbiz/feedback'), 'method'=> 'POST', 'role' => 'form', 'name' => 'feedbackForm', 'id' => 'feedbackForm')) !!}
      <div>
        <ul class="nav nav-tabs">
          <li class="active">
            <a>Feedback Widget Options</a>
          </li>
        </ul>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <input type="checkbox" name="include_social_links" id="include_social_links" value="1" @if($config->include_social_links) checked="checked" @endif>
            <label for="include_social_links" >Include social review links</label>
          </div>
          <div class="form-group">
            <input type="checkbox" name="include_phone" id="include_phone" value="1" @if($config->include_phone) checked="checked" @endif>
            <label for="include_phone"> Ask phone number </label>
          </div>
          <div class="form-group">
            <label for="positive_threshold">
              Positive Feedback Threshold<br>
              <small>Show positive feedback page (including online reviews links) when rating is
              <select name="positive_threshold">
                <option @if($config->positive_threshold == 0.5) selected="selected" @endif>0.5</option>
                <option @if($config->positive_threshold == 1) selected="selected" @endif>1</option>
                <option @if($config->positive_threshold == 1.5) selected="selected" @endif>1.5</option>
                <option @if($config->positive_threshold == 2) selected="selected" @endif>2</option>
                <option @if($config->positive_threshold == 2.5) selected="selected" @endif>2.5</option>
                <option @if($config->positive_threshold == 3) selected="selected" @endif>3</option>
                <option @if($config->positive_threshold == 3.5) selected="selected" @endif>3.5</option>
                <option @if($config->positive_threshold == 4) selected="selected" @endif>4</option>
                <option @if($config->positive_threshold == 4.5) selected="selected" @endif>4.5</option>
                <option @if($config->positive_threshold == 5) selected="selected" @endif>5</option>
              </select>
              or higher</small>
            </label>
          </div>
        </div>
      </div>
      <div>
        <ul class="nav nav-tabs">
          <li class="active">
            <a>Widget Configuration</a>
          </li>
        </ul>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">

          <div class="form-group">
            <label for="page_title">
              Page Title - Call to action
              <small>Leave blank if not desired</small>
            </label>
            <input type="text" name="page_title" id="page_title" class="form-control" value="{{ $config->page_title }}">
          </div>
          <div class="form-group">
            <label for="positive_text">Positive Feedback Page</label>
            <textarea class="form-control noresize" rows="6" name="positive_text" id="positive_text">{{ $config->positive_text }}</textarea>
            <p>Allowed Tags: <span class="label label-info">[REVIEW_LINKS]</span> <span class="label label-info">[YOUR_NAME]</span></p>
          </div>
          <div class="form-group">
            <label for="negative_text">Negative Feedback Page</label>
            <textarea class="form-control noresize" rows="6" name="negative_text" id="negative_text">{{ $config->negative_text }}</textarea>
            <p>Allowed Tags: <span class="label label-info">[YOUR_NAME]</span></p>
          </div>
          <div class="form-group">
            <label for="logo_url">Logo Image Url</label>
            <input type="text" name="logo_url" id="logo_url" class="form-control" value="{{ $config->logo_url }}">
          </div>
          <div class="form-group">
            <label for="banner_url">Banner Page Image Url</label>
            <input type="text" name="banner_url" id="banner_url" class="form-control" value="{{ $config->banner_url }}">
          </div>
          <div class="form-group">
            <label for="stars_style">Stars Style</label>
            <select name="stars_style" class="form-control">
              <option @if($config->stars_style == 'default') selected="selected" @endif>Default</option>
            </select>
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
        <textarea id="codeForSite"  rows="3" class="form-control noresize" readonly="readonly"><iframe src="{{ url("widget/feedback/$product->hash") }}"></iframe></textarea>
        <a target="_blank" href="{{ url("widget/feedback/$product->hash") }}">Test Link</a>
      </div>
    </div>
  </div>
@endsection

