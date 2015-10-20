@extends('dashboard.business.layout')

@section('head')
  <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="{{ asset('/vendor/blueimp-file-upload/css/jquery.fileupload.css') }}">
@endsection

@section('form')

    <h3>Feedback Settings</h3>
    <p>Change your feedback widget from here</p>
    <br>

    {!! Form::open(array('url'=>route('business.dashboard.feedback', $business), 'method'=> 'POST', 'role' => 'form', 'name' => 'feedbackForm', 'id' => 'feedbackForm')) !!}
      <ul class="nav nav-pills" role="tablist">
        <li class="active">
          <a href="#tab_option" aria-controls="tab_option" role="tab" data-toggle="tab">Feedback Widget Options</a>
        </li>
        <li>
          <a href="#tab_config" aria-controls="tab_config" role="tab" data-toggle="tab">Widget Configuration</a>
        </li>
        <li>
          <a href="#tab_code" aria-controls="tab_code" role="tab" data-toggle="tab">Integration</a>
        </li>
      </ul>
      <div class="panel panel-success pilled">
        <div class="panel-heading"></div>
        <div class="panel-body">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab_option">
              <div class="form-group">
                <input type="checkbox" name="include_social_links" id="include_social_links" value="1" @if($config->include_social_links) checked="checked" @endif>
                <label for="include_social_links" > Include social review links</label>
              </div>
              <div class="form-group">
                <input type="checkbox" name="include_phone" id="include_phone" value="1" @if($config->include_phone) checked="checked" @endif>
                <label for="include_phone"> Ask phone number </label>
              </div>
              <div class="form-group">
                <label for="positive_threshold">Positive Feedback Threshold</label>
                <p>
                  Show positive feedback page (including online reviews links) when rating is
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
                  or higher
                </p>
              </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab_config">
              <div class="form-group">
                <label for="page_title">
                  Page Title - Call to action
                  <small>Leave blank if not desired</small>
                </label>
                <input type="text" name="page_title" id="page_title" class="form-control" value="{{ $config->page_title }}">
              </div>
              <div class="form-group">
                <label for="positive_text">Positive Feedback Page</label>
                <textarea class="form-control editable" rows="6" name="positive_text" id="positive_text">{{ $config->positive_text }}</textarea>
              </div>
              <div class="form-group">
                <label for="negative_text">Negative Feedback Page</label>
                <textarea class="form-control editable" rows="6" name="negative_text" id="negative_text">{{ $config->negative_text }}</textarea>
              </div>

              <div class="form-group wc-img-cnt">
                <label for="logo_url">Logo Image</label>
                <!--div class="row">
                  <div class="col-sm-6"-->
                    <p><img src="{{ $config->logo_url }}" class="wc-img-responsive" id="logo"></p>
                    <div id="logo-progress" class="progress" style="display:none">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <div id="logo-ch-btn">
                      <span class="btn btn-success" onclick="$('#logo-ch-btn').hide();$('#logo-ch-options').show();">Change Logo...</span>
                    </div>
                    <div id="logo-ch-options" class="wc-img-options">
                      <p><span class="btn btn-success fileinput-button">
                        <span>Upload New Logo</span>
                        <input id="logo-upload" type="file" name="logo">
                      </span></p>
                      <p><span class="btn btn-success" onclick="cc.bizfeed.gallery('logo')">Use Already Uploaded Logo</span></p>
                      <p><span class="btn btn-success" onclick="cc.bizfeed.external('logo')">Use External Logo Link</span></p>
                    </div>
                  <!--/div>
                  <div class="col-sm-6">
                    <div class="btn-group" role="group">
                      <span class="btn btn-success fileinput-button">
                        <span>Upload</span>
                        <input id="logo-upload" type="file" name="logo">
                      </span>
                      <span class="btn btn-success" onclick="cc.bizfeed.gallery('logo')">Uploaded</span>
                      <span class="btn btn-success" onclick="cc.bizfeed.external('logo')">Link</span>
                    </div>
                  </div>
                </div-->
              </div>

              <div class="form-group wc-img-cnt">
                <label for="banner_url">Banner Page Image</label>
                <!--div class="row">
                  <div class="col-sm-6"-->
                    <p><img src="{{ $config->banner_url }}" class="wc-img-responsive" id="banner"></p>
                    <div id="banner-progress" class="progress" style="display:none">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <div id="banner-ch-btn">
                      <span class="btn btn-success" onclick="$('#banner-ch-btn').hide();$('#banner-ch-options').show();">Change Main Image...</span>
                    </div>
                    <div id="banner-ch-options" class="wc-img-options">
                      <p><span class="btn btn-success fileinput-button">
                        <span>Upload New Image</span>
                        <input id="banner-upload" type="file" name="banner">
                      </span></p>
                      <p><span class="btn btn-success" onclick="cc.bizfeed.gallery('banner')">Use Already Uploaded Image</span></p>
                      <p><span class="btn btn-success" onclick="cc.bizfeed.external('banner')">Use External Image Link</span></p>
                    </div>
                  <!--/div>
                  <div class="col-sm-6">
                    <div class="btn-group" role="group">
                      <span class="btn btn-success fileinput-button">
                        <span>Upload</span>
                        <input id="banner-upload" type="file" name="banner">
                      </span>
                      <span class="btn btn-success" onclick="cc.bizfeed.gallery('banner')">Uploaded</span>
                      <span class="btn btn-success" onclick="cc.bizfeed.external('banner')">Link</span>
                    </div>
                  </div>
                </div-->
              </div>

              <div class="form-group">
                <label for="stars_style">Stars Style</label>
                <select name="stars_style" class="form-control wc-select">
                  <option @if($config->stars_style == 'default') selected="selected" @endif>Default</option>
                </select>
              </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab_code">
              <div class="form-group">
                <label>Widget Code <small>Use this code to add the feedback widget on your site</small></label>
                <pre>{{ htmlentities('<iframe src="' . url("widget/feedback/$product->hash") . '"></iframe>') }}</pre>
              </div>
              <div class="row">
                <div class="col-sm-12 text-right">
                  <a class="btn btn-default btn-sm" href="{{ url("widget/feedback/$product->hash") }}" target="_blank">Test Link</a>
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


@section('footer')

  @parent

  <script type="text/javascript" src="{{ asset('/vendor/tinymce/tinymce.min.js') }}"></script>

  <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
  <script type="text/javascript" src="{{ asset('/vendor/blueimp-file-upload/js/jquery.iframe-transport.js') }}"></script>
  <!-- The basic File Upload plugin -->
  <script  type="text/javascript" src="{{ asset('/vendor/blueimp-file-upload/js/jquery.fileupload.js') }}"></script>

  <script id="gallery_HBT" type="text/x-handlebars-template">
    @{{#if images}}
      <div class="row">
        @{{#each images}}
          <div class="col-xs-4">
            <a href="javascript:;" class="thumbnail" onclick="cc.bizfeed.selected(this)" data-image="@{{this}}">
              <img src="@{{this}}" alt="Image">
            </a>
          </div>
        @{{/each}}
      </div>
    @{{else}}
      <p class="text-center">Images not found</p>
    @{{/if}}
  </script>

  <script id="external_HBT" type="text/x-handlebars-template">
    <div class="box-body">
      <div class="form-group">
        <label for="external_link">Image Link</label>
        <input type="text" name="external_link" placeholder="Enter Image Link" id="external_link" class="form-control"/>
      </div>
    </div>
  </script>

  <script  type="text/javascript" src="{{ asset('/js/cc.bizfeed.js') }}"></script>
  <script>
    $(function () {
        cc.bizfeed.init('{{ $business->uuid }}');
    });
  </script>
@endsection
