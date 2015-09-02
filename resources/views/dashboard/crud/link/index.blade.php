@extends('dashboard.crud.layout')

@section('title')
  <section class="content-header">
    <h1>
      Online Review Links
      <small>This is the landing page of the online review links on business dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Business</a></li>
      <li class="active">Links</li>
    </ol>
  </section>
@endsection

@section('content')

  <div class="box box-primary collapse" id="linkAdd">
    <div class="box-header with-border">
      <h3 class="box-title">Add Social Media Profile</h3>
    </div>
    <div id="linkAddForm_HBW"></div>
    <div class="overlay" id="linkAddLoading">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
  </div>

  <div class="box box-primary collapse" id="linkEdit">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Social Media Profile</h3>
    </div>
    <div id="linkEditForm_HBW"></div>
    <div class="overlay" id="linkEditLoading">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
  </div>

  <!-- Default box -->
  <div class="box collapse in" id="linkTable">
    <div class="box-header with-border">
      
      <a class="btn btn-app" onclick="cc.crud.link.add.create()">
        <i class="fa fa-plus"></i> Add Profile
      </a>
    </div>

    <div class="box-body">
      <div id="linkTable_HBW"></div>
    </div><!-- /.box-body -->
    <div class="overlay" id="linkTableLoading">
      <i class="fa fa-refresh fa-spin"></i>
    </div>

  </div>
  <!-- /.box -->

@endsection

@section('footer')
  <!-- Adding templates -->
  <script id="linkAddForm_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.link.addForm')
  </script>
  <script id="linkEditForm_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.link.editForm')
  </script>
  <script id="linkTable_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.link.table')
  </script>

  <script id="modalAdmins_HBT" type="text/x-handlebars-template">
    <div class="list-group">
      @{{#each admins}}
        <a href="javascript:;" onclick="cc.crud.link.admin.result('@{{id}}','@{{name}}','@{{email}}');cc.dashboard.modal.hide()" class="list-group-item">@{{name}} - @{{email}}</a>
      @{{/each}}
    </div>
  </script>

<!-- Users dashboard script  -->
  <script type="text/javascript" src="/js/cc.crud.link.js"></script>

  <script type="text/javascript">
  var socialNetworks = {!! json_encode($social_networks) !!};
    $(function () {
      cc.crud.link.init();

    });
  </script>
@endsection

