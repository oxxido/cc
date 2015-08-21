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
        <section class="content-header">
          <h1>
            Users Dashboard
            <small>This is the landing page of the user dashboard</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Users</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content" id="content-dashboard">
          <!-- TIP -->
          @if(\Session::has('message'))
              <div class="callout callout-info">
                  <p>{{ Session::get('message') }}</p>
              </div>
          @endif

          <div class="alert alert-dismissable collapse" id="errorMessage">
            <button type="button" class="close" data-toggle="collapse" data-target="#errorMessage" aria-hidden="true">&times;</button>
            <h4><i class="icon fa" id="errorIcon"></i><span id="errorTitle"> Warning!</span></h4>
            <div></div>
          </div>

          <div class="box box-primary collapse" id="adminAdd">
            <div class="box-header with-border">
              <h3 class="box-title">Add User</h3>
            </div>
            <div id="adminAddForm_HBW"></div>
            <div class="overlay" id="adminAddLoading">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
          </div>

          <div class="box box-primary collapse" id="adminEdit">
            <div class="box-header with-border">
              <h3 class="box-title">Edit User</h3>
            </div>
            <div id="adminEditForm_HBW"></div>
            <div class="overlay" id="adminEditLoading">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
          </div>

          <!-- Default box -->
          <div class="box collapse in" id="adminTable">
            <div class="box-header with-border">
              <a class="btn btn-app" onclick="cc.crud.admin.add.create();">
                <i class="fa fa-plus"></i> Add User
              </a>
            </div>
            <div class="box-body">
              <div id="adminTable_HBW"></div>
            </div><!-- /.box-body -->
            <div class="overlay" id="adminTableLoading">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="box-footer">
              Footer
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.2.0
        </div>
        
      </footer>

    </div><!-- ./wrapper -->

    <!-- Adding templates -->
    <script id="adminEditForm_HBT" type="text/x-handlebars-template">
      @include('dashboard.admin.editForm')
    </script>
    <script id="adminAddForm_HBT" type="text/x-handlebars-template">
      @include('dashboard.admin.addForm')
    </script>
    <script id="adminTable_HBT" type="text/x-handlebars-template">
      @include('dashboard.admin.table')
    </script>

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
            <button type="button" class="btn btn-primary hide">Confirm</button>
          </div>
        </div>
      </div>
    </div>

  @endif
@endsection

@section('footer')
<!-- Users dashboard script  -->
<script type="text/javascript" src="/js/cc.crud.admin.js"></script>

<script type="text/javascript">
    $(function () {
      cc.crud.admin.init();
    });
</script>
@endsection