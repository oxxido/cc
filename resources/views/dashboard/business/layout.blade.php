@extends('dashboard.layout')

@section('title')
  <section class="content-header">
    <h1>
      {{ $business->name }}
      <small>Change your business settings from here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      @if(Auth::user()->isOwner())
        <li><a href="{{ url('dashowner') }}">Dashboard</a></li>
        <li><a href="{{ url('dashowner/business') }}">Business</a></li>
      @elseif(Auth::user()->isAdmin())
        <li><a href="{{ url('dashadmin') }}">Dashboard</a></li>
        <li><a href="{{ url('dashadmin/business') }}">Business</a></li>
      @endif
      <li class="active">{{ $business->name }}</li>
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

  <ul class="nav nav-tabs">
    <li role="presentation"><a href="{{ route('business.dashboard', $business) }}">Business Data</a></li>
    <li role="presentation"><a href="{{ route('business.dashboard.links', $business) }}">Online Review Links</a></li>
    <li role="presentation">
      <a href="{{ url('business/'.$business->uuid.'/customers') }}" data-href-create="{{ url('business/'.$business->uuid.'/customer/create') }}">Manage Customers</a></li>
    <li role="presentation" class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        Settings <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li><a href="{{ route('business.dashboard.email', $business) }}">Email Settings</a></li>
        <li><a href="{{ route('business.dashboard.feedback', $business) }}">Feedback Settings</a></li>
        <li><a href="{{ route('business.dashboard.testimonial', $business) }}">Testimonials Settings</a></li>
        <li><a href="{{ route('business.dashboard.notification', $business) }}">Notification Settings</a></li>
      </ul>
    </li>
    <li role="presentation"><a href="#widgets" aria-controls="widgets" role="tab" data-toggle="tab">Widgets &amp; Codes</a></li>
  </ul>
  <div class="panel panel-default tabed" id="config-form">
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="main">
        @yield('form')
      </div>
      <div role="tabpanel" class="tab-pane" id="widgets">
        <div class="form-group">
          <label for="codeForSite">Widget Testimonial Code</label>
          <p>Use this code to add the testimonial widget on your site</p>
          <pre>{{ htmlentities('<script type="text/javascript" id="cc-widget-testimonial-'.$business->hash.'" src="'.url("widget/script.js?type=testimonial&uuid={$business->hash}").'"></script>') }}</pre>
        </div>
        <hr>
        <div class="form-group">
          <label for="codeForSite">Widget Feedback Code</label>
          <p>Use this code to add the feedback widget on your site
          <pre>{{ htmlentities('<script type="text/javascript" id="cc-widget-testimonial-'.$business->hash.'" src="'.url("widget/script.js?type=feedback&uuid={$business->hash}").'"></script>') }}</pre>
        </div>
        <hr>
        <div class="form-group">
          <label for="codeForSite">Links</label>
          <ul>
            <li><a href="{{ url('widget/testimonial/landing/'.$business->hash) }}" target="_blank">Testimonials Langing Page</a></li>
            <li><a href="{{ url('widget/feedback/landing/'.$business->hash) }}" target="_blank">Feedback Langing Page</a></li>
            <li><a href="{{ url('widget/test/'.$business->hash) }}" target="_blank">Widgets Live Preview</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('footer')
  <script>
    $(function() {
      var liHref = $("[href='"+window.location.href+"'], [data-href-create='"+window.location.href+"'], [data-href-edit='"+window.location.href+"']");
      if(liHref.parent().parent().parent().attr('role') == "presentation")
      {
        liHref.parent().parent().parent().addClass('active');
      }
      liHref.parent().addClass('active');
      liHref.attr({
        "href": "#main",
        "aria-controls": "main",
        "role": "tab",
        "data-toggle": "tab"
      }).click(function (e) {
        e.preventDefault()
        $(this).tab('show')
      });
    });
  </script>
@endsection
