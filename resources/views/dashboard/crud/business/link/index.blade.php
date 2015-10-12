@extends('dashboard.business.layout')

@section('form')

  <h3>Online Review Links</h3>
  <p>This is the landing page of the online review links on business dashboard</p>
  <br>

  <div class="box box-success box-solid collapse" id="linkAdd">
    <div class="box-header">Add Social Media Profile</div>
    <div id="linkAddForm_HBW"></div>
    <div class="overlay" id="linkAddLoading">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
  </div>

  <div class="box box-success box-solid collapse" id="linkEdit">
    <div class="box-header">Edit Social Media Profile</div>
    <div id="linkEditForm_HBW"></div>
    <div class="overlay" id="linkEditLoading">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
  </div>

  <!-- Default box -->
  <div class="box box-success box-solid collapse in" id="linkTable">
    <div class="box-header">
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
  
  @parent

  <!-- Adding templates -->
  <script id="linkAddForm_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.business.link.addForm')
  </script>
  <script id="linkEditForm_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.business.link.editForm')
  </script>
  <script id="linkTable_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.business.link.table')
  </script>

<!-- Users dashboard script  -->
  <script type="text/javascript" src="/js/cc.crud.link.js"></script>

  <script type="text/javascript">
  var socialNetworks = {!! json_encode($social_networks) !!};
  $(function () {
    cc.crud.link.init('{{ $business->uuid }}');
  });
  </script>
@endsection

