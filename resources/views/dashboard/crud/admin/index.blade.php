@extends('dashboard.crud.layout')

@section('title')
  <section class="content-header">
    <h1>
      Manage Users
      <small>This is the landing page to manage users</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Dashboard</a></li>
      <li class="active">Manage Users</li>
    </ol>
  </section>
@endsection

@section('content')
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
  <div class="box box-primary collapse in" id="adminTable">
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
  </div><!-- /.box -->
@endsection

@section('footer')

  <!-- Adding templates -->
  <script id="adminEditForm_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.admin.editForm')
  </script>
  <script id="adminAddForm_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.admin.addForm')
  </script>
  <script id="adminTable_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.admin.table')
  </script>

  <!-- Users dashboard script  -->
  <script type="text/javascript" src="/js/cc.crud.admin.js"></script>

  <script type="text/javascript">
      $(function () {
        cc.crud.admin.init();
      });
  </script>
@endsection