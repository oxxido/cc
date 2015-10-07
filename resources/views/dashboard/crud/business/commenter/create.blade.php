@extends('dashboard.business.layout')

@section('form')

  <h3>Add Customer</h3>
  <p>Here you can select customers to be possible reviewers of your business</p>
  <br>

  {!! Form::model($commenter, ['route' => ['business.commenter.store', $business]]) !!}
    <div class="box box-success box-solid collapse in" id="commenters_table">
      <div class="box-header">
        Commenter Data
      </div>
      <div class="box-body">
        <div class="form-group">
          {!! Form::label('email') !!}
          {!! Form::email('email', null, ['placeholder' => trans('user.fields.email'), 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('first_name') !!}
          {!! Form::text('first_name', null, ['placeholder' => trans('user.fields.first_name'), 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('last_name') !!}
          {!! Form::text('last_name', null, ['placeholder' => trans('user.fields.last_name'), 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('phone') !!}
          {!! Form::text('phone', null, ['placeholder' => trans('commenter.fields.phone'), 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('note') !!}
          {!! Form::text('note', null, ['placeholder' => trans('commenter.fields.note'), 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('send_feedback_request', 'Send Feedback Request Now') !!}
          {!! Form::checkbox('send_feedback_request', null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="box-footer">
        <a href="{{ URL::route('business.commenters', $business) }}" class="btn btn-default">Back</a>
        {!! Form::submit('Send', ['class' => 'btn btn-success']) !!}
      </div>
    </div>
  {!! Form::close() !!}
@endsection
