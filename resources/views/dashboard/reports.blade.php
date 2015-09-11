@extends('dashboard.layout')

@section('title')
  <section class="content-header">
    <h1>
      Reports Dashboard
      <small> </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Dashboard</a></li>
      <li class="active">Reports</li>
    </ol>
  </section>
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $report['own']['count'] }}</h3>
          <p>Businesses Owned</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>

      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $report['own']['comments'] }}</h3>
          <p>Total Comments</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>

      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ number_format($report['own']['avg_ratings'], 2) }}</h3>
          <p>Avg Rating</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>

      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ $report['own']['sum_ratings'] }}</h3>
          <p>Sum Rating</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>

      </div>
    </div><!-- ./col -->
  </div>

  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $report['admin']['count'] }}</h3>
          <p>Businesses Administrated</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>

      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $report['admin']['comments'] }}</h3>
          <p>Total Admin Comments</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>

      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ number_format($report['admin']['avg_ratings'], 2) }}</h3>
          <p>Admin Avg Rating</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>

      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ $report['own']['sum_ratings'] }}</h3>
          <p>Admin Sum Rating</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>

      </div>
    </div><!-- ./col -->
  </div>
@endsection

