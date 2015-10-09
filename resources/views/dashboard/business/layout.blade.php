@extends('dashboard.layout')

@section('title')
  <section class="content-header">
    <h1>
      {{ $business->name }}
      <small>Change your business settings from here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      @if(\Auth::user()->isOwner())
        <li><a href="{{ url('dashowner') }}">Dashboard</a></li>
        <li><a href="{{ url('dashowner/business') }}">Business</a></li>
      @elseif(\Auth::user()->isAdmin())
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
    <!-- <li role="presentation"><a href="{{ url('dashbiz/edit') }}">Business Data</a></li> -->
    <li role="presentation"><a href="{{ url('dashbiz/link') }}">Online Review Links</a></li>
    <li role="presentation">
      <a href="{{ url("business/{$business->uuid}/customers") }}" data-href-create="{{ url("business/{$business->uuid}/customer/create") }}">Manage Customers</a></li>
    <li role="presentation" class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        Settings <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li><a href="{{ url('dashbiz/email') }}">Email Settings</a></li>
        <li><a href="{{ url('dashbiz/feedback') }}">Feedback Settings</a></li>
        <li><a href="{{ url('dashbiz/testimonial') }}">Testimonials Settings</a></li>
        <li><a href="{{ url('dashbiz/notification') }}">Notification Settings</a></li>
      </ul>
    </li>
  </ul>
  <div class="panel panel-default tabed" id="config-form">
    @yield('form')
  </div>

@endsection

@section('footer')
  <script>
    $(function() {
      var liHref = $("[href='"+window.location.href+"'], [data-href-create='"+window.location.href+"'], [data-href-edit='"+window.location.href+"']").parent();
      if(liHref.parent().parent().attr('role') == "presentation")
      {
        liHref.parent().parent().addClass('active');
      }
      liHref.addClass('active');
    });
  </script>
@endsection
