@extends('dashboard.crud.layout')

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

@section('content')

  <div class="box box-primary collapse in" id="businessAdd">
    <div class="box-header with-border">
      <h3 class="box-title">Testimonial Widget Options</h3>
    </div>

  <div class="panel panel-default">
    <div class="panel-body">
      <div class="form-group">
        <input type="checkbox" name="includeFeedback" id="includeFeedback"  >
        <label for="name" >Include feedback form</label>
      </div>
      <div class="form-group">
        <label for="codeForSite">Widget Code <small>Use this code to add the testimonial widget on your site</small></label>
        <textarea name="codeForSite"  rows="3" class="form-control"> code </textarea>
      </div>
    </div>

    <div class="box-footer">
      <button class="btn btn-primary" type="submit">Save</button>
    </div>

  </div>


  



</div><!-- /.box-body --></div>
    
  </div>


@endsection
