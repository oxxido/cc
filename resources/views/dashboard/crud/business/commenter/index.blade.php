@extends('dashboard.business.layout')

@section('head')
  <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="{{ asset('/vendor/blueimp-file-upload/css/jquery.fileupload.css') }}">
@endsection

@section('form')

  <h3>Customers list</h3>
  <p>This is the list of available customers for this business</p>
  <br>

  <div class="box box-primary collapse" id="cvsNotifications">
    <div class="box-header with-border">
      <h3 class="box-title">Import CSV logs</h3>
    </div>
    <div class="box-body">
      <div class="table-log">
        <table class="table table-condensed table-hover">
        </table>
      </div>
    </div>
    <div class="box-footer" style="display:none">
        <a href="javascript:;" onclick="location.reload()" class="btn btn-default">Close</a>
    </div>
  </div>

  <div class="box box-success box-solid collapse in" id="commenters_table">
    <div class="box-header">
      <div>
        <a href="{{ URL::route('business.commenter.create', $business) }}" class="btn btn-app">
          <i class="fa fa-plus"></i> Add Customer
        </a>
        <div class="btn-group btn-app-group">
          <a class="btn btn-app fileinput-button">
            <i class="fa fa-file-excel-o"></i> Upload CSV
            <input id="csv-upload" type="file" name="csv" data-url="{{ URL::route('business.commenters.import', $business) }}">
          </a>
          <button type="button" class="btn btn-default dropdown-toggle btn-app" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ asset('downloads/commenters.csv') }}">Download CSV example</a></li>
            <li><a href="{{ asset('downloads/commenters.xls') }}">Download XLS example</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="box-body">
      @include('dashboard.crud.business.commenter.table', [$business, 'commenters_page' => $business->commenters()->paginate()])
    </div>
  </div>
@endsection

@section('footer')
  
  @parent

  <script type="text/javascript" src="{{ asset('/vendor/pusher/dist/pusher.min.js') }}"></script>
  <script type="text/javascript" src="/js/cc.pusher.js"></script>

  <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
  <script type="text/javascript" src="{{ asset('/vendor/blueimp-file-upload/js/jquery.iframe-transport.js') }}"></script>
  <!-- The basic File Upload plugin -->
  <script  type="text/javascript" src="{{ asset('/vendor/blueimp-file-upload/js/jquery.fileupload.js') }}"></script>

  <script type="text/javascript" src="/js/cc.crud.business.commenter.js"></script>

  <script type="text/javascript">
    $(function () {
      cc.crud.business.commenter.business_uuid = "{{ $business->uuid }}";
      cc.crud.business.commenter.init();
    });
  </script>
@endsection
