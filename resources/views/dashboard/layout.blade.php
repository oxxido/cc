@extends('layouts.admin')

@section('body')
  @if (Auth::guest())
    <a href="{{ url('auth/login') }}">Client Login</a>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ str_limit(Auth::user()->name,10) }} <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('auth/logout') }}">Logout</a></li>
        </ul>
    </li>
  @else
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="/dashboard" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><i class="fa fa-shield"></i>CC</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><i class="fa fa-shield"></i> Certified Comments</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          @include('includes.admin.topmenu')
        </nav>
      </header>

      @include('includes.admin.menu')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('title')

        <!-- Main content -->
        <section class="content">
          <!-- TIP -->
          @if(\Session::has('message'))
            <div class="callout callout-info alert alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>{{ Session::get('message') }}</p>
            </div>
          @endif

          <div class="alert alert-dismissable collapse" id="errorMessage">
            <button type="button" class="close" data-toggle="collapse" data-target="#errorMessage" aria-hidden="true">&times;</button>
            <h4><i class="icon fa" id="errorIcon"></i><span id="errorTitle"> Warning!</span></h4>
            <div></div>
          </div>

          <div id="content-dashboard">
            @yield('content')
          </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-{{ date("Y") }} <a href="{{ url("/") }}">CertifiedComments.com</a>.</strong> Unlawful duplication prohibited by Law.
      </footer>

    </div><!-- ./wrapper -->

    <div class="modal" id="dashboard-modal">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary hide">Save</button>
          </div>
        </div>
      </div>
    </div>

    @yield('foot')

  @endif
@endsection
