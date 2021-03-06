@extends('dashboard.crud.layout')

@section('title')
  <section class="content-header">
    <h1>
      Business Dashboard
      <small>This is the landing page of the business dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Dashboard</a></li>
      <li class="active">Business</li>
    </ol>
  </section>
@endsection

@section('content')

  <div class="box box-primary collapse" id="businessAdd">
    <div class="box-header with-border">
      <h3 class="box-title">Add Business</h3>
    </div>
    <div id="businessAddForm_HBW"></div>
    <div class="overlay" id="businessAddLoading">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
  </div>

  <div class="box box-primary collapse" id="businessEdit">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Business</h3>
    </div>
    <div id="businessEditForm_HBW"></div>
    <div class="overlay" id="businessEditLoading">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
  </div>

  <!-- Default box -->
  <div class="box collapse in" id="businessTable">
    <div class="box-header with-border">
      <a class="btn btn-app" onclick="cc.crud.business.add.create()">
        <i class="fa fa-plus"></i> Add Business
      </a>
    </div>
    <div class="box-body">
      <div id="businessesTable_HBW"></div>
    </div><!-- /.box-body -->
    <div class="overlay" id="businessTableLoading">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
  </div><!-- /.box -->
@endsection

@section('footer')

  <!-- Adding templates -->
  <script id="businessEditForm_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.business.editForm')
  </script>
  <script id="businessAddForm_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.business.addForm')
  </script>
  <script id="businessesTable_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.business.table')
  </script>

  <script id="modalLocations_HBT" type="text/x-handlebars-template">
    <div class="list-group">
      @{{#each locations}}
        <a href="javascript:;" onclick="cc.location.result('@{{id}}','@{{location}}');cc.dashboard.modal.hide()" class="list-group-item">@{{location}}</a>
      @{{/each}}
    </div>
  </script>

  <script id="modalAdmins_HBT" type="text/x-handlebars-template">
    <div class="list-group">
      @{{#each admins}}
        <a href="javascript:;" onclick="cc.crud.business.admin.result('@{{id}}','@{{name}}','@{{email}}');cc.dashboard.modal.hide()" class="list-group-item">@{{name}} - @{{email}}</a>
      @{{/each}}
    </div>
  </script>

  <!-- Users dashboard script  -->
  <script type="text/javascript" src="/js/cc.crud.business.js"></script>

  <script type="text/javascript">
    $(function () {
      cc.crud.business.init();
    });
  </script>

@endsection

