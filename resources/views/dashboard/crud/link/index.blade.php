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

  <!-- Default box -->
  <div class="box collapse in" id="linkTable">
    <div class="box-header with-border">
      Choose each review profile that you would like to display from the drop down and then press "Add rofile" button. You can drag to re-order them too!
      <p></p>

      <div class="form-group">
        <label for="social_network_id">Social Network</label>
        <select class="form-control" name="social_network_id" placeholder="Enter Social Network" id="social_network_id">
          <option></option>
          @foreach ($social_networks as $social_network)
            <option value="{{ $social_network->id }}">{{ $social_network->name }}</option>
          @endforeach
        </select>
      </div>

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


    <div class="form-group">
        <img src="{{ $social_network->logo }}" width="50"> 
        <input type="checkbox">Show URL in Testimonials Widget and on thank-you page
        <br>
        
        <label for="name"></label>
        <input type="text" name="name" placeholder="Enter link to {{ $social_network->name }} profile page" id="name" class="form-control" value="" required>
        <br>
        
        <input type="button" value="Move Up" onclick="">
        <input type="button" value="Move Down" onclick="">
        <input type="button" value="Delete" onclick="">
        <input type="button" value="Visit URL" onclick="">
    </div>

  </div>
  <!-- /.box -->

@endsection

@section('footer')
  <script id="businessesTable_HBT" type="text/x-handlebars-template">
    @include('dashboard.crud.link.table')
  </script>

<!-- Users dashboard script  -->
  <script type="text/javascript" src="/js/cc.crud.link.js"></script>

  <script type="text/javascript">
    $(function () {
      cc.crud.link.init();
    });
  </script>
@endsection

