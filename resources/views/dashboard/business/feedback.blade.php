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
            <input type="checkbox" name="includeSocialLinks" id="includeSocialLinks" @if($config->includeSocialLinks) checked="checked" @endif>
            <label for="includeSocialLinks" >Include social review links</label>
          </div>
          <div class="form-group">
            <input type="checkbox" name="includePhone" id="includePhone" @if($config->includePhone) checked="checked" @endif>
            <label for="includePhone"> Ask phone number </label>
          </div>
          <div class="form-group">
            <label for="positiveThreshold">
              Positive Feedback Threshold<br>
              <small>Show positive feedback page (including online reviews links) when rating is
              <select name="positiveThreshold">
                <option @if($config->positiveThreshold == 0.5) selected="selected" @endif>0.5</option>
                <option @if($config->positiveThreshold == 1) selected="selected" @endif>1</option>
                <option @if($config->positiveThreshold == 1.5) selected="selected" @endif>1.5</option>
                <option @if($config->positiveThreshold == 2) selected="selected" @endif>2</option>
                <option @if($config->positiveThreshold == 2.5) selected="selected" @endif>2.5</option>
                <option @if($config->positiveThreshold == 3) selected="selected" @endif>3</option>
                <option @if($config->positiveThreshold == 3.5) selected="selected" @endif>3.5</option>
                <option @if($config->positiveThreshold == 4) selected="selected" @endif>4</option>
                <option @if($config->positiveThreshold == 4.5) selected="selected" @endif>4.5</option>
                <option @if($config->positiveThreshold == 5) selected="selected" @endif>5</option>
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
            <label for="pageTitle">
              Page Title - Call to action
              <small>Leave blank if not desired</small>
            </label>
            <input type="text" name="pageTitle" id="pageTitle" class="form-control" value="{{ $config->pageTitle }}">
          </div>
          <div class="form-group">
            <label for="positiveFeedbackPage">Positive Feedback Page</label>
            <textarea class="form-control noresize" rows="6" name="positiveFeedbackPage" id="positiveFeedbackPage">{{ $config->positiveFeedbackPage }}</textarea>
          </div>
          <div class="form-group">
            <label for="negativeFeedbackPage">Negative Feedback Page</label>
            <textarea class="form-control noresize" rows="6" name="negativeFeedbackPage" id="negativeFeedbackPage">{{ $config->negativeFeedbackPage }}</textarea>
          </div>
          <div class="form-group">
            <label for="logoUrl">Logo Image Url</label>
            <input type="text" name="logoUrl" id="logoUrl" class="form-control" value="{{ $config->logoUrl }}">
          </div>
          <div class="form-group">
            <label for="bannerUrl">Banner Page Image Url</label>
            <input type="text" name="bannerUrl" id="bannerUrl" class="form-control" value="{{ $config->bannerUrl }}">
          </div>
          <div class="form-group">
            <label for="starsStyle">Stars Style</label>
            <select name="starsStyle" class="form-control">
              <option @if($config->starsStyle == 'default') selected="selected" @endif>Default</option>
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

