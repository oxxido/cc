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


  @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  @if (isset($saved))
      <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <p>Successfully saved!</p>
      </div>
  @endif

  <div class="box box-primary collapse in" id="testimonialConfig">

    {!! Form::open(array('url'=>url('dashbiz/testimonial'), 'method'=> 'POST', 'role' => 'form', 'name' => 'testimonialForm', 'id' => 'testimonialForm')) !!}
      <div class="box-header with-border">
        <h3 class="box-title">Testimonial Widget Options</h3>
      </div>

      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <input type="checkbox" name="includeFeedback" id="includeFeedback">
            <label for="name" >Include feedback form</label>
          </div>
          <div class="form-group">
            <label for="codeForSite">Widget Code <small>Use this code to add the testimonial widget on your site</small></label>
            <textarea name="codeForSite"  rows="3" class="form-control" readonly="readonly"> code </textarea>
          </div>
        </div>

        <div class="box-footer">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>

      </div>
    {!! Form::close() !!}

  </div>

@endsection
