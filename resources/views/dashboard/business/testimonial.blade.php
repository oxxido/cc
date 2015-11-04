@extends('dashboard.business.layout')

@section('form')

  <h3>Testimonial Settings</h3>
  <p>Change your testimonial widget from here</p>
  <br>

  {!! Form::open(array('url'=>route('business.dashboard.testimonial', $business), 'method'=> 'POST', 'role' => 'form', 'name' => 'testimonialForm', 'id' => 'testimonialForm')) !!}
    <ul class="nav nav-pills" role="tablist">
      <li class="active">
        <a href="#tab_config" aria-controls="tab_config" role="tab" data-toggle="tab">Testimonial Widget Options</a>
      </li>
      <li>
        <a href="#tab_code" aria-controls="tab_code" role="tab" data-toggle="tab">Code</a>
      </li>
    </ul>
    <div class="panel panel-success pilled">
      <div class="panel-heading"></div>
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
              <label for="codeForSite">Widget Code</label>
              <p>Use this code to add the testimonial widget on your site</p>
              <pre>{{ htmlentities('<script type="text/javascript" id="cc-widget-testimonial-'.$product->hash.'" src="'.url("widget/script.js?type=testimonial&uuid=$product->hash").'"></script>') }}</pre>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <a href="{{ url("widget/testimonial/landing/$product->hash") }}" target="_blank">Testimonial Landing Page</a>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="panel-footer">
        <button class="btn btn-success" type="submit">Save</button>
      </div>
    </div>
  {!! Form::close() !!}
@endsection
