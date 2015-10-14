@extends('dashboard.layout')

@section('title')
  <section class="content-header">
    <h1>
      Account Owner Details
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      @if(Auth::user()->isOwner())
        <li><a href="{{ url('dashowner') }}">Dashboard</a></li>
      @elseif(Auth::user()->isAdmin())
        <li><a href="{{ url('dasadmin') }}">Dashboard</a></li>
      @endif
      <li class="active">Account</li>
    </ol>
  </section>
@endsection

@section('content')
  <div class="box box-primary">
    <div class="box-body">
      <div id="accountdiv">
        {!! Form::model($user, array('route' => array('user.update'))) !!}

          {!! Form::token() !!}
          {!! Form::hidden('user_id',$user->id) !!}

          <div class="box-body">
            <div class="form-group">
              {!! Form::label('first_name', 'First Name') !!}
              {!! Form::text('first_name', null,array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('last_name', 'Last Name') !!}
              {!! Form::text('last_name', null,array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('email', 'E-Mail Address') !!}
              {!! Form::text('email', null,array('class' => 'form-control', 'readonly')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('password', 'Update Password') !!}
              {!! Form::text('password', "", array('class' => 'form-control', 'id'=>'password')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('password_confirmation', 'Re-enter Password') !!}
              {!! Form::text('password_confirmation', "", array('class' => 'form-control')) !!}
            </div>
          </div><!-- /.box-body -->

          <div class="box-footer">
            <button class="btn btn-primary" type="submit" id="userAddSubmit" >Update Account</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script type="text/javascript" src="{{ asset('/vendor/pwstrength-bootstrap/dist/pwstrength-bootstrap-1.2.7.min.js') }}"></script>
  <script type="text/javascript">
    $(function () {

      $('#password').pwstrength({ui: {
          showVerdictsInsideProgressBar: true
      } });
    });
  </script>
@endsection
