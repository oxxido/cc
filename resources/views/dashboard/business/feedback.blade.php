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

  <div class="box box-primary collapse in" id="businessAdd">
  <!--  <div class="box-header with-border">
      <h3 class="box-title">Feedback Widget Options</h3>
    </div>-->
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
        <input type="checkbox" name="includeSocialLinks" id="includeSocialLinks"  >
        <label for="includeSocialLinks" >Include social review links</label>
      </div>
      <div class="form-group">
        <input type="checkbox" name="includePhone" id="includePhone"  >
        <label for="includePhone"> Ask phone number </label>
      </div>
      <div class="form-group">
        <select name="threshold">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
        </select>
        <label for="includeSocialLinks">Positive Feedback Threshold</label>
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
        <label for="admin_first_name">Page Title - Call to action</label>
        <input type="text" name="pageTitle" id="pageTitle" class="form-control">
      </div>
      <div class="form-group">
        <label for="admin_first_name">Logo Image Url</label>
        <input type="text" name="logoUrl" id="logoUrl" class="form-control">
      </div>
      <div class="form-group">
        <label for="admin_first_name">Banner Page Image Url</label>
        <input type="text" name="bannerUrl" id="bannerUrl" class="form-control">
      </div>
      <div class="form-group">
        <label for="admin_first_name">Stars Style</label>
        <input type="text" name="stars" id="stars" class="form-control">
      </div>

    </div>
    <div class="box-footer">
      <button class="btn btn-primary" type="submit">Save</button>
    </div>
  </div>


</div><!-- /.box-body --></div>
    
  </div>


@endsection

