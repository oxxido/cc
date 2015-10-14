@extends('dashboard.layout')

@section('title')
  <section class="content-header">
    <h1>
      Reports Dashboard
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      @if(Auth::user()->isOwner())
        <li><a href="{{ url('dashowner') }}">Dashboard</a></li>
      @elseif(Auth::user()->isAdmin())
        <li><a href="{{ url('dasadmin') }}">Dashboard</a></li>
      @endif
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

  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $report['negative_comments'] }}</h3>
          <p>Negative Comments</p>
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
          <h3>{{ $report['request'] }}</h3>
          <p>Request Sent</p>
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
          <h3>{{ number_format($report['request_open_rate'], 2) }}%</h3>
          <p>Feedback Request Open Rate</p>
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
          <h3>{{ $report['unrequested_comment'] }}</h3>
          <p>Anonymous Reviews</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>

      </div>
    </div><!-- ./col -->
  </div>
  <!-- donut chart -->
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Feedback Request and Response</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse">
          <i class="fa fa-minus"></i>
        </button>
        <button class="btn btn-box-tool" data-widget="remove">
          <i class="fa fa-times"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <canvas id="pieChart" style="height: 252px; width: 504px;" width="504" height="252"></canvas>
    </div>
  </div>
  <!-- bar chart -->
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Positive and Negative Feedbacks</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse">
          <i class="fa fa-minus"></i>
        </button>
        <button class="btn btn-box-tool" data-widget="remove">
          <i class="fa fa-times"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div class="chart">
        <canvas id="barChart" style="height: 230px; width: 484px;" width="484" height="230"></canvas>
      </div>
    </div>
  </div>


@endsection

@section('foot')
  <script type="text/javascript" src="../vendor/admin-lte/plugins/chartjs/Chart.js"></script>
  <script type="text/javascript" src="../vendor/admin-lte/plugins/chartjs/Chart.min.js"></script>
  <script type="text/javascript" src="/js/reports.js"></script>

  <script type="text/javascript">
      var data = <?php echo json_encode($report); ?>;
    //$(function () {
      cc.reports.init(data);
    //});
  </script>

@endsection