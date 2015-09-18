@extends('dashboard.business.layout')

@section('head')
  <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="{{ asset('/vendor/blueimp-file-upload/css/jquery.fileupload.css') }}">
@endsection

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
      <ul class="nav nav-tabs" role="tablist">
        <li>
          <a href="#tab_option" aria-controls="tab_option" role="tab" data-toggle="tab">Feedback Widget Options</a>
        </li>
        <li class="active">
          <a href="#tab_config" aria-controls="tab_config" role="tab" data-toggle="tab">Widget Configuration</a>
        </li>
        <li>
          <a href="#tab_code" aria-controls="tab_code" role="tab" data-toggle="tab">Integration</a>
        </li>
      </ul>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane" id="tab_option">
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
                  Positive Feedback Threshold</label>
                  <br/>
                  Show positive feedback page (including online reviews links) when rating is
                  <br />
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
              </div>
            </div>

            <div role="tabpanel" class="tab-pane active" id="tab_config">
              <div class="form-group hidden">
                <label for="page_title">
                  Page Title - Call to action
                  <small>Leave blank if not desired</small>
                </label>
                <input type="text" name="page_title" id="page_title" class="form-control" value="{{ $config->page_title }}">
              </div>
              <div class="form-group hidden">
                <label for="positive_text">Positive Feedback Page</label>
                <textarea class="form-control editable" rows="6" name="positive_text" id="positive_text">{{ $config->positive_text }}</textarea>
              </div>
              <div class="form-group hidden">
                <label for="negative_text">Negative Feedback Page</label>
                <textarea class="form-control editable" rows="6" name="negative_text" id="negative_text">{{ $config->negative_text }}</textarea>
              </div>

              <div class="form-group">
                <label for="logo_url">Logo Image Url</label>
                <!-- <input type="text" name="logo_url" id="logo_url" class="form-control" value="{{ $config->logo_url }}"> -->
                <div class="row">
                  <div class="col-sm-6">
                    <img src="{{ $config->logo_url }}" class="img-responsive" id="logo">
                  </div>
                  <div class="col-sm-6">
                    <span class="btn btn-success fileinput-button">
                      <span>Upload Image</span>
                      <!-- The file input field used as target for the file upload widget -->
                      <input id="logo-upload" type="file" name="logo" multiple>
                    </span>
                    <span class="btn btn-success" onclick="cc.bizfeed.gallery('logo')">Select Image</span>
                    <span class="btn btn-success" onclick="cc.bizfeed.external('logo')">External Link</span>
                  </div>
                </div>
                  <!-- The fileinput-button span is used to style the file input field as button -->
                  <br>
                  <br>
                  <!-- The global progress bar -->
                  <div id="logo-progress" class="progress" style="display:none">
                      <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <!-- The container for the uploaded files -->
                  <div id="logo-file" class="files"></div>
                </div>
              </div>

              <div class="form-group hidden">
                <label for="banner_url">Banner Page Image Url</label>
                <!-- <input type="text" name="banner_url" id="banner_url" class="form-control" value="{{ $config->banner_url }}"> -->
                <div>
                  <!-- The fileinput-button span is used to style the file input field as button -->
                  <span class="btn btn-success fileinput-button">
                    <span>Select file</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="banner-upload" type="file" name="banner" multiple>
                  </span>
                  <br>
                  <br>
                  <!-- The global progress bar -->
                  <div id="banner-progress" class="progress">
                      <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <!-- The container for the uploaded files -->
                  <div id="banner-file" class="files"></div>
                </div>
              </div>

              <div class="form-group hidden">
                <label for="stars_style">Stars Style</label>
                <select name="stars_style" class="form-control">
                  <option @if($config->stars_style == 'default') selected="selected" @endif>Default</option>
                </select>
              </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab_code">
              <div class="form-group">
                <label>Widget Code <small>Use this code to add the testimonial widget on your site</small></label>
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
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
      </div>
    {!! Form::close() !!}

@endsection


@section('footer')

  <script type="text/javascript" src="{{ asset('/vendor/tinymce/tinymce.min.js') }}"></script>
  <script type="text/javascript">
    // tinymce.init({
    //   selector: "textarea.editable",
    //   height: 300,
    //   statusbar: false,
    //   toolbar: "undo redo taging",
    //   menubar: false,
    //   object_resizing: false,
    //   external_plugins: {
    //     "taging": "{{ asset('/js/vendor/taging/plugin.min.js') }}"
    //   }
    // });

    // $("#feedbackForm").bind('submit', function(){
    //   $("textarea").each(function(i, textarea){
    //     var body = $(textarea).val();
    //     tinymce.editors[0].destroy();
    //     $(textarea).val(body);
    //   });
    //   return true;
    // });
  </script>

  <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
  <script type="text/javascript" src="{{ asset('/vendor/blueimp-file-upload/js/jquery.iframe-transport.js') }}"></script>
  <!-- The basic File Upload plugin -->
  <script  type="text/javascript" src="{{ asset('/vendor/blueimp-file-upload/js/jquery.fileupload.js') }}"></script>

  <script id="gallery_HBT" type="text/x-handlebars-template">
    @{{#if images}}
      <div class="row">
        @{{#each images}}
          <div class="col-xs-6 col-md-3">
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

  <script>
  $(function () {
    cc.bizfeed = {
      gallery : function(target)
      {
        $.ajax({
          url : cc.baseUrl + 'dashbiz/gallery',
          dataType : 'json',
          data : {
            target : target
          }
        })
        .done(function(data) {
          cc.dashboard.modal.handlebars("Select Image", "#gallery_HBT", data);
          cc.dashboard.modal.size("modal-lg");
          $("#dashboard-modal .thumbnail").data("target", target);
        })
        .fail(tools.fail);
      },
      selected : function(link)
      {
        var target = $(link).data("target");
        var image = $(link).data("image");
        this.save(target, image);
      },
      external : function(target)
      {
        cc.dashboard.modal.handlebars("External Image", "#external_HBT", {}, function(){
          var image = $("#external_link").val();
          cc.bizfeed.save(target, image);
        });
      },
      save : function(target, image)
      {
        $.ajax({
          url : cc.baseUrl + 'dashbiz/image',
          dataType : 'json',
          type : "POST",
          data : {
            _token : '{{ csrf_token() }}',
            target : target,
            image : image
          }
        })
        .done(function(data) {
          cc.dashboard.modal.hide();
          $('#logo').attr("src", image);  
        })
        .fail(tools.fail);
      }
    };

    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '{{ url("dashbiz/upload") }}';
    $('#logo-upload').fileupload({
      url: url,
      dataType: 'json',
      formData : {
        _token : '{{ csrf_token() }}',
        target : 'logo'
      },
      submit : function(e, data) {
        $('#logo-progress').show();
        return true;
      },
      done: function (e, data) {
        $('#logo').attr("src", data.result.image);
        $('#logo-progress').hide();
      },
      progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#logo-progress .progress-bar').css(
          'width',
          progress + '%'
        );
      }
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    $('#banner-upload').fileupload({
        url: url,
        dataType: 'json',
        formData : {
          _token : '{{ csrf_token() }}',
          target : 'banner'
        },
        done: function (e, data) {
          $('<img/>').attr("src", data.result.image).html('#logo-file');
        },
        progressall: function (e, data) {
          var progress = parseInt(data.loaded / data.total * 100, 10);
          $('#banner-progress .progress-bar').css(
            'width',
            progress + '%'
          );
        }
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
  });
  </script>
@endsection
