@extends('dashboard.layouts')

@section('title')
  <section class="content-header">
    <h1>
      Help Dashboard
      <small></small>
    </h1>
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      @if(Auth::user()->isOwner())
        <li><a href="{{ url('dashowner') }}">Dashboard</a></li>
      @elseif(Auth::user()->isAdmin())
        <li><a href="{{ url('dasadmin') }}">Dashboard</a></li>
      @endif
      <li class="active">Help</li>
    </ol>
  </section>
@endsection

@section('content')
  <div class="box">
    <div class="box-body">
      <div id="widgetDiv">
        <!-- ============================================================= -->
        <section id="dependencies">
          <h2 class="page-header"><a href="#dependencies">Dependencies</a></h2>
          <p class="lead">AdminLTE depends on two main frameworks. The downloadable package contains both of these libraries, so you don't have to manually download them.</p>
          <ul class="bring-up">
            <li><a href="http://getbootstrap.com" target="_blank">Bootstrap 3</a></li>
            <li><a href="http://jquery.com/" target="_blank">jQuery 1.11+</a></li>
            <li><a href="#plugins">All other plugins are listed below</a></li>
          </ul>
        </section>
        <!-- ============================================================= -->
        <section id="advice">
          <h2 class="page-header"><a href="#advice">A Word of Advice</a></h2>
          <p class="lead">Before you go to see your new awesome theme, here are few tips on how to familiarize yourself with it:</p>
          <ul>
            <li><b>AdminLTE is based on <a href="http://getbootstrap.com/" target="_blank">Bootstrap 3</a>.</b> If you are unfamiliar with Bootstrap, visit their website and read through the documentation. All of Bootstrap components have been modified to fit the style of AdminLTE and provide a consistent look throughout the template. This way, we guarantee you will get the best of AdminLTE.</li>
            <li><b>Go through the pages that are bundled with the theme.</b> Most of the template example pages contain quick tips on how to create or use a component which can be really helpful when you need to create something on the fly.</li>
            <li><b>Documentation.</b> We are trying our best to make your experience with AdminLTE be smooth. One way to achieve that is to provide documentation and support. If you think that something is missing from the documentation, please do not hesitate to create an issue to tell us about it. Also, if you would like to contribute, email the support team at <a href="mailto:support@almsaeedstudio.com">support@almsaeedstudio.com</a>.</li>
            <li><b>Built with <a href="http://lesscss.org/" target="_blank">LESS</a>.</b> This theme uses the LESS compiler to make it easier to customize and use. LESS is easy to learn if you know CSS or SASS. It is not necessary to learn LESS but it will benefit you a lot in the future.</li>
            <li><b>Hosted on <a href="https://github.com/almasaeed2010/AdminLTE/" target="_blank">GitHub</a>.</b> Visit our GitHub repository to view issues, make requests, or contribute to the project.</li>
          </ul>
          <p><b>Note:</b> LESS files are better commented than the compiled CSS file.</p>
        </section>
      </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endsection
