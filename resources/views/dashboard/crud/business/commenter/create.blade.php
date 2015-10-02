@extends('dashboard.crud.layout')

@section('title')
    <section class="content-header">
        <h1>
            Business <b>{{ $business->name }}</b>
            <small>Associate customers</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Business</a></li>
            <li><a href="#">Customer</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
@endsection

@section('content')
    @if (count($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($commenter, ['route' => ['business.commenter.store', $business]]) !!}
        <div class="box box-primary collapse in" id="commenters_table">
            <div class="box-header with-border">
                Here you can select customers to be possible reviewers of your business
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
            </div>
            <div class="box-footer">
                <div class="text-right">
                    <a href="{{ URL::route('business.commenters', $business) }}" class="btn btn-default">Back</a>
                    {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
