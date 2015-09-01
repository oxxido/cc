@extends('dashboard.crud.layout')

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

@section('content')

  <div class="box box-primary collapse in" id="feedbakConfig">

      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

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
            <input type="checkbox" name="includeSocialLinks" id="includeSocialLinks">
            <label for="includeSocialLinks" >Include social review links</label>
          </div>
          <div class="form-group">
            <input type="checkbox" name="includePhone" id="includePhone">
            <label for="includePhone"> Ask phone number </label>
          </div>
          <div class="form-group">
            <select name="positiveThreshold">
              <option>0.5</option>
              <option>1</option>
              <option>1.5</option>
              <option>2</option>
              <option>2.5</option>
              <option selected="selected">3</option>
              <option>3.5</option>
              <option>4</option>
              <option>4.5</option>
              <option>5</option>
            </select>
            <label for="positiveThreshold">Positive Feedback Threshold</label>
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
            <label for="pageTitle">Page Title - Call to action</label>
            <input type="text" name="pageTitle" id="pageTitle" class="form-control" value="{{ old('pageTitle') }}">
          </div>
          <div class="form-group">
            <label for="logoUrl">Logo Image Url</label>
            <input type="text" name="logoUrl" id="logoUrl" class="form-control" value="{{ old('logoUrl') }}">
          </div>
          <div class="form-group">
            <label for="bannerUrl">Banner Page Image Url</label>
            <input type="text" name="bannerUrl" id="bannerUrl" class="form-control" value="{{ old('bannerUrl') }}">
          </div>
          <div class="form-group">
            <label for="starsStyle">Stars Style</label>
            <input type="text" name="starsStyle" id="starsStyle" class="form-control" value="{{ old('starsStyle') }}">
          </div>

        </div>
        <div class="box-footer">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div><!-- /.box-body -->

@endsection

